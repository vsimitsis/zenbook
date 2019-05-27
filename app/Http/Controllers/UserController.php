<?php

namespace App\Http\Controllers;

use App\Traits\AddressTrait;
use App\Traits\ContactTrait;
use App\userRole;
use App\Country;
use App\Http\Requests\UserRequest;
use App\Mail\UserInvitation;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    use AddressTrait, ContactTrait;

    /**
     * Return the users index page
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('users.index', [
            'users'     => $this->fetchUsers($request),
            'userRoles' => UserRole::all(),
            'search'    => $request->search,
            'status'    => $request->status,
            'role'      => $request->role,
        ]);
    }

    /**
     * Return the user's show page
     *
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(User $user)
    {
        return view('users.show', [
            'user' => $user,
            'contacts' => $user->contacts,
            'addresses' => $user->addresses
        ]);
    }

    /**
     * Return the user create page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $user = new User();

        return view('users.create', [
            'user'      => $user,
            'contacts'  => $user->contacts,
            'addresses' => $user->addresses,
            'company'   => Auth::user()->company,
            'userRoles' => UserRole::all(),
            'countries' => Country::all(),
        ]);
    }

    /**
     * Store a newly created user
     *
     * @param UserRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(UserRequest $request)
    {
        $this->authorize('create', User::class);

        $currentUser = Auth::user();

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'company_id' => $currentUser->company->id,
            'user_role_id' => $request->user_role,
            'password' => Hash::make(str_random(8)),
            'avatar' => null,
            'status' => User::PENDING
        ]);

        if ($user->save()) {
            $token = app('auth.password.broker')->createToken($user);

            Mail::to($user->email)->send(new UserInvitation($currentUser, $user, $token));

            return redirect(route('user.index'))
                ->with('success', 'The user has been created successfully and an invitation was sent.');
        }

        return redirect(route('users.create'))
            ->with('error', 'There was a problem creating the user.');
    }

    /**
     * Return the user edit page
     *
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(User $user)
    {
        $this->authorize('edit', $user);

        return view('users.edit', [
            'user'      => $user,
            'company'   => $user->company,
            'contacts'  => $user->contacts,
            'addresses' => $user->addresses,
            'userRoles' => UserRole::all(),
            'countries' => Country::all(),
        ]);
    }

    /**
     * Update the user's account
     *
     * @param UserRequest $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(UserRequest $request, User $user)
    {
        $this->authorize('edit', $user);

        if ($this->updateDetails($request, $user)) {
            $this->storeContacts($request, $user, true);
            $this->storeAddresses($request, $user, true);

            return redirect(route('user.index'))
                ->with('success', 'User\'s account has been updated successfully.');
        }

        return redirect(route('user.index'))
            ->with('error', 'There was a problem updating the user\'s account');
    }

    /**
     * Delete the specific user
     *
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        if ($user->delete()) {
            return redirect(route('user.index'))
                ->with('success', $user->name . ' has been deleted successfully.');
        }

        return redirect(route('user.edit', $user))
            ->with('error', 'There was a problem deleting this user. Please try again later.');
    }

    /**
     * Update the status of the user
     *
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function updateStatus(Request $request, User $user)
    {
        $currentUser = Auth::user();

        $this->authorize('manage', $currentUser->company);

        if ($currentUser->is($user)) {
            return redirect(route('user.edit', $user))
                ->with('error', 'You can\'t update the status of your own account.');
        }

        $user->status = $request->status;

        if ($user->save()) {
            return redirect(route('user.index'))
                ->with('success', 'The account status has been updated successfully.');
        }

        return redirect(route('user.edit', $user))
            ->with('error', 'There was a problem updating the status. Please try again later.');
    }

    /**
     * Update the user's details
     *
     * @param UserRequest $request
     * @param User $user
     * @return bool
     */
    private function updateDetails(UserRequest $request, User $user)
    {
        $user->name  = $request->name;
        $user->email = $request->email;
        $user->user_role_id = $request->user_role;

        return $user->save();
    }

    /**
     * Checks if the whole array is empty
     *
     * @param array $data
     * @return bool
     */
    protected function arrayIsNull(array $data)
    {
        $emptyArray = true;

        foreach ($data as $field) {
            if ($field) {
                $emptyArray = false;
                break;
            }
        }

        return $emptyArray;
    }

    /**
     * Fetch company's users and filter them
     *
     * @param Request $request
     * @return mixed
     */
    protected function fetchUsers(Request $request)
    {
        $company = Auth::user()->company;
        $userQuery   = $company->users();

        if ($request->search) {
            $userQuery = $userQuery->where(function ($query) use ($request) {
                $query->where('name', 'LIKE', '%' . $request->search . '%')
                ->orWhere('email', 'LIKE', '%' . $request->search . '%');
            });
        }

        switch ($request->status) {
            case 'active':
                $userQuery = $userQuery->where('status', User::ACTIVE);
                break;
            case 'pending':
                $userQuery = $userQuery->where('status', User::PENDING);
                break;
            case 'suspended':
                $userQuery = $userQuery->where('status', User::SUSPENDED);
                break;
        }

        switch ($request->role) {
            case 'administrator':
                $userQuery = $userQuery->where('user_role_id', UserRole::ADMINISTRATOR);
                break;
            case 'teacher':
                $userQuery = $userQuery->where('user_role_id', UserRole::TEACHER);
                break;
            case 'student':
                $userQuery = $userQuery->where('user_role_id', UserRole::STUDENT);
                break;
        }

        return $userQuery->paginate(10);
    }
}

<?php

namespace App\Http\Controllers;

use App\Address;
use App\CompanyRole;
use App\Contact;
use App\Country;
use App\Http\Requests\UserRequest;
use App\Mail\UserInvitation;
use App\Timezone;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Return the users index page
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('users.index', [
            'users'  => $this->fetchUsers($request),
            'search' => $request->search,
            'status' => $request->status,
            'role'   => $request->role,
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

    public function create()
    {
        $user = new User();

        return view('users.create', [
            'user' => $user,
            'contacts' => $user->contacts,
            'addresses' => $user->addresses,
            'company' => Auth::user()->company,
            'companyRoles' => CompanyRole::all(),
            'countries' => Country::all(),
            'timezones' => Timezone::all()
        ]);
    }

    public function store(UserRequest $request)
    {
        $this->authorize('create', User::class);

        $currentUser = Auth::user();

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'timezone_id' => $request->timezone,
            'company_id' => $currentUser->company->id,
            'company_role_id' => $request->company_role,
            'password' => Hash::make(str_random(8)),
            'avatar' => null,
            'status' => User::PENDING
        ]);

        if ($user->save()) {
            $token = app('auth.password.broker')->createToken($user);

            Mail::to($user->email)->send(new UserInvitation($currentUser, $user, $token));

            return redirect(route('users.index'))
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
            'user' => $user,
            'company' => $user->company,
            'contacts' => $user->contacts,
            'addresses' => $user->addresses,
            'companyRoles' => CompanyRole::all(),
            'countries' => Country::all(),
            'timezones' => Timezone::all()
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
            $this->insertContacts($request, $user, true);
            $this->insertAddresses($request, $user, true);

            return redirect(route('users.index'))
                ->with('success', 'User\'s account has been updated successfully.');
        }

        return redirect(route('users.index'))
            ->with('error', 'There was a problem updating the user\'s account');
    }

    /**
     * Delete the specific user
     *
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function delete(User $user)
    {
        if ($user->delete()) {
            return redirect(route('users.index'))
                ->with('success', $user->name . ' has been deleted successfully.');
        }

        return redirect(route('users.edit', $user))
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
            return redirect(route('users.edit', $user))
                ->with('error', 'You can\'t update the status of your own account.');
        }

        $user->status = $request->status;

        if ($user->save()) {
            return redirect(route('users.index'))
                ->with('success', 'The account status has been updated successfully.');
        }

        return redirect(route('users.edit', $user))
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
        $user->timezone_id = $request->timezone;
        $user->company_role_id = $request->company_role;

        return $user->save();
    }

    /**
     * Remove and re attach all the new contacts
     *
     * @param UserRequest $request
     * @param User $user
     * @param boolean $update
     */
    private function insertContacts(UserRequest $request, User $user, $update = false)
    {
        if ($update) {
            $user->contacts()->delete();
            $user->contacts()->detach();
        }

        if ($request->get('contact-list')) {
            foreach ($request->get('contact-list') as $newContact) {
                if ($this->arrayIsNull($newContact)) {
                    continue;
                }

                $contact = Contact::create([
                    'email' => $newContact['email'],
                    'mobile' => $newContact['mobile'],
                    'landline' => $newContact['landline']
                ]);
                $user->contacts()->attach($contact->id);
            }
        }
    }

    /**
     * Remove and re attach all the new addresses
     *
     * @param UserRequest $request
     * @param User $user
     * @param boolean $update
     */
    private function insertAddresses(UserRequest $request, User $user, $update = false)
    {
        if ($update) {
            $user->addresses()->delete();
            $user->addresses()->detach();
        }

        if ($request->get('address-list')) {
            foreach ($request->get('address-list') as $newAddress) {
                if ($this->arrayIsNull($newAddress)) {
                    continue;
                }

                $address = Address::create([
                    'building_name' => $newAddress['building_name'],
                    'address1' => $newAddress['address1'],
                    'address2' => $newAddress['address2'],
                    'postcode' => $newAddress['postcode'],
                    'city' => $newAddress['city'],
                    'country_id' => $newAddress['country'] != 0 ? $newAddress['country'] : null,
                ]);
                $user->addresses()->attach($address->id);
            }
        }
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
                $userQuery = $userQuery->where('company_role_id', CompanyRole::ADMINISTRATOR);
                break;
            case 'manager':
                $userQuery = $userQuery->where('company_role_id', CompanyRole::MANAGER);
                break;
            case 'employee':
                $userQuery = $userQuery->where('company_role_id', CompanyRole::EMPLOYEE);
                break;
        }

        return $userQuery->get();
    }
}

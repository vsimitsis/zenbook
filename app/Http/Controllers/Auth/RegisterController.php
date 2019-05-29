<?php

namespace App\Http\Controllers\Auth;

use App\Company;
use App\userRole;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'alpha', 'max:55'],
            'last_name'  => ['required', 'alpha', 'max:55'],
            'email'      => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'company'    => ['required', 'string', 'max:255'],
            'password'   => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return mixed
     */
    protected function create(array $data)
    {
        //Create the company
        $company = Company::create([
            'name' => $data['company'],
        ]);

        return User::create([
            'unique_ref'    => User::generateUniqueID(),
            'first_name'   => $data['first_name'],
            'last_name'    => $data['last_name'],
            'email'        => $data['email'],
            'company_id'   => $company->id,
            'user_role_id' => userRole::ADMINISTRATOR,
            'password'     => Hash::make($data['password']),
            'status'       => User::ACTIVE
        ]);
    }
}

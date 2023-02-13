<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller {
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
   protected $redirectTo = RouteServiceProvider::HOME;

   /**
    * Create a new controller instance.
    *
    * @return void
    */
   public function __construct() {
      $this->middleware('guest');
   }

   /**
    * Get a validator for an incoming registration request.
    *
    * @param  array  $data
    * @return \Illuminate\Contracts\Validation\Validator
    */
   protected function validator(array $data) {
      return Validator::make($data, [
         'name' => ['required', 'string', 'min:3', 'max:255'],
         'email' => ['required', 'regex:/(.+)@(.+)\.(\w{2,})/i', 'unique:users'],
         'password' => ['required', 'string', 'min:8', 'confirmed'],
      ], $this->messages());
   }

   protected function messages() {
      return [
         'name' => [
            'required' => __('validation.name.required'),
            'string' => __('validation.name.string'),
            'min' => __('validation.name.min'),
            'max' => __('validation.name.max'),
         ],
         'email' => [
            'required' => __('validation.email.required'),
            'string' => __('validation.email.string'),
            'regex' => __('validation.email.regex'),
            'max' => __('validation.email.max'),
            'unique' => __('validation.email.unique'),
         ],
         'password' => [
            'required' => __('validation.password.required'),
            'string' => __('validation.password.string'),
            'min' => __('validation.password.min'),
            'confirmed' => __('validation.password.confirmed'),
         ],
      ];
   }

   /**
    * Create a new user instance after a valid registration.
    *
    * @param  array  $data
    * @return \App\Models\User
    */
   protected function create(array $data) {
      return User::create([
         'name' => $data['name'],
         'email' => $data['email'],
         'password' => Hash::make($data['password']),
      ]);
   }
}
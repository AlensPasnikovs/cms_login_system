<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller {
   /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

   use AuthenticatesUsers;

   /**
    * Where to redirect users after login.
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
      $this->middleware('guest')->except('logout');
   }

   protected function validateLogin(Request $request) {
      $request->validate([
         $this->username() => [
            'required',
            'regex:/(.+)@(.+)\.(\w{2,})/i'
         ],
         'password' => 'required|string',
      ], $this->messages());
   }


   protected function messages() {
      return [
         $this->username() => [
            'required' => __('validation.email.required'),
            'regex' => __('validation.email.regex'),
         ],
         'password' => [
            'required' => __('validation.password.required'),
            'string' => __('validation.password.string'),
         ],
      ];
   }
}
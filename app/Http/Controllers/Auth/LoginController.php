<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

   protected function authenticated(Request $request, $user) {
      // Check if the user has a subdomain.
      if (!empty($user->subdomain)) {
         // Generate a new token for this login session.
         $token = Str::random(32);
         DB::table('sso_tokens')->insert([
            'token' => $token,
            'user_id' => $user->id,
         ]);

         // Redirect to the user's container.
         return redirect("http://{$user->subdomain}.prakse.localhost/sso-entry?token={$token}");
      }
      // If the user doesn't have a container, redirect them to the default post-login location.
      return redirect()->intended($this->redirectPath());
   }


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

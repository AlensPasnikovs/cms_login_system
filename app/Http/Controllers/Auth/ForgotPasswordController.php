<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller {
   /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

   use SendsPasswordResetEmails;


   protected function validateEmail(Request $request) {
      $request->validate(['email' => [
         'required',
         'regex:/(.+)@(.+)\.(\w{2,})/i'
      ]], $this->messages());
   }

   public function messages() {
      return [
         'email' => [
            'required' => __('validation.email.required'),
            'regex' => __('validation.email.regex'),
         ],
      ];
   }
}
<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\Password;
use App\Http\Requests\PasswordUpdateRequest;

class PasswordController extends Controller {
   /**
    * Update the user's password.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\RedirectResponse
    */
   // public function update(Request $request) {
   //    $validated = $request->validateWithBag('updatePassword', [
   //       'current_password' => ['required', 'current_password'],
   //       'password' => ['required', Password::defaults(), 'confirmed'],
   //    ]);

   //    $request->user()->update([
   //       'password' => Hash::make($validated['password']),
   //    ]);

   //    return back()->with('status', 'password-updated');
   // }

   public function update(PasswordUpdateRequest $request) {
      $validated = $request->validated();
      $request->user()->update([
         'password' => Hash::make($validated['password']),
      ]);
      return redirect()->back()->with('status', __("messages.password_updated"));
   }
}
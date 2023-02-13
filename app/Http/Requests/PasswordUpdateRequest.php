<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class PasswordUpdateRequest extends FormRequest {
   /**
    * Determine if the user is authorized to make this request.
    *
    * @return bool
    */
   public function authorize() {
      return true;
   }

   /**
    * Get the validation rules that apply to the request.
    *
    * @return array<string, mixed>
    */
   public function rules() {
      return [
         'current_password' => ['required', 'current_password'],
         'password' => ['required', 'string', 'min:8', 'confirmed'],
      ];
   }
   public function messages() {
      return [
         'current_password' => [
            'required' => __('validation.current_password.required'),
            'current_password' => __('validation.current_password.current_password'),
         ],
         'password' => [
            'required' => __('validation.password.required'),
            'string' => __('validation.password.string'),
            'min' => __('validation.password.min'),
            'confirmed' => __('validation.password.confirmed'),
         ],
      ];
   }
}
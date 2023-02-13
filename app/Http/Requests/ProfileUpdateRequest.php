<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest {
   /**
    * Get the validation rules that apply to the request.
    *
    * @return array<string, mixed>
    */
   public function rules() {
      return [
         'name' => ['required', 'string', 'min:3', 'max:255'],
         'email' => ['required', 'regex:/(.+)@(.+)\.(\w{2,})/i', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
      ];
   }
   public function messages() {
      return [
         'name' => [
            'required' => __('validation.name.required'),
            'string' => __('validation.name.string'),
            'min' => __('validation.name.min'),
            'max' => __('validation.name.max'),
         ],
         'email' => [
            'required' => __('validation.email.required'),
            'regex' => __('validation.email.regex'),
            'max' => __('validation.email.max'),
         ],
      ];
   }
}
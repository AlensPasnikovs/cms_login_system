<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest {
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
      if ($this->getMethod() == 'PUT') {
         return [
            'post_title' => 'required|max:255',
            'post_content' => 'required',
            'post_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
         ];
      }
      return [
         'post_title' => 'required|max:255',
         'post_content' => 'required',
         'post_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      ];
   }
   public function messages() {
      return [
         // 'post_title.required' => 'Title is required',
         // 'post_content.required' => 'Content is required',
         // 'post_image.required' => 'Image is required',
      ];
   }
}
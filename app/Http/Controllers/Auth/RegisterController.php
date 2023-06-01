<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Jobs\ProcessBlogSetup;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;


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

   public function register(Request $request) {
      $start = microtime(true);
      $this->validator($request->all())->validate();

      $user = $this->create($request->all());
      $subdomain = $user->subdomain;

      $token = Str::random(32);
      DB::table('sso_tokens')->insert([
         'token' => $token,
         'user_id' => $user->id,
      ]);

      $time_taken = null;
      // Dispatch the event here, after the user is created.

      $button = $request->input('button');
      event(new \App\Events\NewUserRegistered($subdomain, $button));

      $this->guard()->login($user);

      // Poll the new blog until it's ready.
      $client = new Client();
      $ready = false;
      while (!$ready) {
         try {
            $response = $client->get("http://{$subdomain}.prakse.localhost");
            if ($response->getStatusCode() === 200) {
               $ready = true;
               $end = microtime(true);
               $time_taken = $end - $start;
               return redirect("http://{$subdomain}.prakse.localhost/sso-entry?token={$token}&time_taken={$time_taken}");
            }
         } catch (GuzzleException $e) {
            // The request failed, wait a bit before trying again
            sleep(0.5);
         }
      }

      if ($response = $this->registered($request, $user)) {
         return $response;
      }

      $end = microtime(true);
      $time_taken = $end - $start;
      return $request->wantsJson()
         ? new JsonResponse([], 201)
         : redirect("http://{$subdomain}.prakse.localhost/sso-entry?token={$token}&time_taken={$time_taken}"); // Change the redirect URL to use the subdomain and include the sso-entry route
   }




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
         'subdomain' => ['required', 'string', 'max:255', 'regex:/^[a-z0-9]([-a-z0-9]{0,253}[a-z0-9])?$/', 'unique:users'],

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
         'subdomain' => [
            'required' => __('validation.subdomain.required'),
            'string' => __('validation.subdomain.string'),
            'max' => __('validation.subdomain.max'),
            'unique' => __('validation.subdomain.unique'),
            'regex' => __('validation.subdomain.regex'),
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
         'subdomain' => $data['subdomain'],
      ]);
   }
}
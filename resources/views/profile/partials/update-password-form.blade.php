<div class="card-body">
   <h4>
      {{ __('messages.update_password') }}
   </h4>
   <p class="mt-1 text-sm text-gray-600">
      {{ __('messages.update_password_text') }}
   </p>

   
   <form id="profile_password_form" method="POST" action="{{ route('passwordController.update') }}">
      @csrf
      @method('put')
      <div class="mb-3">
         <label for="current_password" class="col-form-label text-md-end">{{ __('messages.current_password') }}</label>
         <div class="col-md-10 col-lg-6">
            <input id="current_password" type="password" class="form-control  shadow-sm" name="current_password"
               autocomplete="current-password">
               <ul class="text-danger my-2">
                  @foreach ($errors->get('current_password') as $error)
                     <li>{{ $error }}</li>
                  @endforeach
               </ul>
         </div>
      </div>
      <div class="mb-3">
         <label for="password" class="col-form-label text-md-end">{{ __('messages.new_password') }}</label>
         <div class="col-md-10 col-lg-6">
            <input id="password" type="password" class="form-control  shadow-sm" name="password"
               autocomplete="new-password">
               <ul class="text-danger my-2">
                  @foreach ($errors->get('password') as $error)
                     <li>{{ $error }}</li>
                  @endforeach
               </ul>
         </div>
      </div>
      <div class="mb-3">
         <label for="password-confirm" class="col-form-label text-md-end">{{ __('messages.confirm_new_password') }}</label>
         <div class="col-md-10 col-lg-6">
            <input id="password-confirm" type="password" class="form-control shadow-sm"
               name="password_confirmation" autocomplete="new-password">
               <ul class="text-danger my-2">
                  @foreach ($errors->get('password_confirmation') as $error)
                     <li>{{ $error }}</li>
                  @endforeach
               </ul>
         </div>
         <div>
            <x-save-button />
         </div>
      </div>
   </form>
</div>
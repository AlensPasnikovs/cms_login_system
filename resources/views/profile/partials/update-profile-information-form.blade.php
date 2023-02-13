<div class="card-body">
   <h4 class="">
      {{ __('messages.profile_info') }}
   </h4>
   <p class="mt-1 text-sm text-gray-600">
      {{ __("messages.update_profile_text") }}
   </p>
   <form id="profile_info_form" method="POST" action="{{ route('profile.edit') }}">
      @csrf
      @method('patch')
      <div class="mb-3">
         <label for="name" class="col-form-label text-md-end">{{ __('messages.name') }}</label>
         <div class="col-sm-12 col-md-10 col-lg-6">
            <input id="name" type="text" class="form-control shadow-sm js-name" name="name"
               value="{{ old('name', $user->name) }}"  autocomplete="name" autofocus>
               <ul class="text-danger my-2">
                  @foreach ($errors->get('name') as $error)
                     <li>{{ $error }}</li>
                  @endforeach
               </ul>
         </div>
      </div>
      <div class="mb-3">
         <label for="email" class="col-form-label text-md-end">{{ __('messages.email') }}</label>
         <div class="col-md-10 col-lg-6">
            <input type="text" class="form-control shadow-sm js-email" name="email"
               value="{{ old('email', $user->email) }}"  autocomplete="email" >
               {{-- <ul class="text-danger my-2">
                  <li id="email_error" class="d-none"></li>
               </ul> --}}
               <ul class="text-danger my-2">
                  @foreach ($errors->get('email') as $error)
                     <li>{{ $error }}</li>
                  @endforeach
               </ul>
         </div>
      </div>
      <div>
         <x-save-button />
      </div>
   </form>

</div>


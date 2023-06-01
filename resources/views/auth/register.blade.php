@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-8">
         <div class="card">
            <div class="card-header">{{ __('messages.register') }}</div>

            <div class="card-body">
               <form method="POST" action="{{ route('register') }}">
                  @csrf

                  <div class="row mb-3">
                     <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('messages.name') }}</label>

                     <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                           name="name" value="{{ old('name') }}" autocomplete="name" autofocus>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>

                  <div class="row mb-3">
                     <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('messages.email') }}</label>

                     <div class="col-md-6">
                        <input id="email" type="text" class="form-control @error('email') is-invalid @enderror"
                           name="email" value="{{ old('email') }}" autocomplete="email">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>

                  <div class="row mb-3">
                     <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('messages.password')
                        }}</label>

                     <div class="col-md-6">
                        <input id="password" type="password"
                           class="form-control @error('password') is-invalid @enderror" name="password"
                           autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>

                  <div class="row mb-3">
                     <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{
                        __('messages.confirm_password') }}</label>

                     <div class="col-md-6">
                        <input id="password_confirm" type="password" class="form-control" name="password_confirmation"
                           autocomplete="new-password">

                     </div>
                  </div>

                  <div class="row mb-3">
                     <label for="subdomain" class="col-md-4 col-form-label text-md-end">{{ __('messages.subdomain')
                        }}</label>

                     <div class="col-md-6">
                        <input id="subdomain" type="text" class="form-control @error('subdomain') is-invalid @enderror"
                           name="subdomain" value="{{ old('subdomain') }}" autocomplete="subdomain" autofocus>

                        @error('subdomain')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>

                  <div class="row mb-0">
                     <div class="col-md-6 offset-md-4 d-flex justify-content-between">
                        <div class="d-flex align-items-center">
                           <button type="submit" name="button" value="1" class="btn btn-primary mr-3"
                              id="registerButton1" onclick="registerButtonClick('1')">
                              <span id="buttonText1">{{ __('messages.register') }}</span>
                              <span id="buttonSpinner1" class="spinner-border spinner-border-sm" role="status"
                                 aria-hidden="true" style="display: none;"></span>
                           </button>
                           <div id="timer1" class="btn btn-light py-0" style="display: none; pointer-events: none;">
                              <strong>
                                 <span id="time1" style="font-size: 1.4em; color: black;">0</span> sec
                              </strong>
                           </div>
                        </div>
                        <div class="d-flex align-items-center">
                           <button type="submit" name="button" value="2" class="btn btn-primary" id="registerButton2"
                              onclick="registerButtonClick('2')">
                              <span id="buttonText2">{{ __('messages.register') }}</span>
                              <span id="buttonSpinner2" class="spinner-border spinner-border-sm" role="status"
                                 aria-hidden="true" style="display: none;"></span>
                           </button>
                           <div id="timer2" class="btn btn-light py-0 mr-3"
                              style="display: none; pointer-events: none;">
                              <strong>
                                 <span id="time2" style="font-size: 1.4em; color: black;">0</span> sec
                              </strong>
                           </div>
                        </div>
                     </div>
                  </div>


               </form>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection

@section('scripts')

<script>
   var timers = { '1': null, '2': null };
   
   function registerButtonClick(buttonId) {
   var form = document.querySelector('form');
   var button = document.getElementById('registerButton' + buttonId);
   var spinner = document.getElementById('buttonSpinner' + buttonId);
   var text = document.getElementById('buttonText' + buttonId);
   var timerElement = document.getElementById('timer' + buttonId);
   var timeElement = document.getElementById('time' + buttonId);

   // Show the spinner, timer, and change the button text
   spinner.style.display = 'inline-block';
   timerElement.style.display = 'inline-block';
   text.textContent = '{{ __('messages.creating_profile') }}';

   // Reset the timer
   timeElement.textContent = '0';
   if (timers[buttonId] !== null) {
       clearInterval(timers[buttonId]);
   }

   // Start the timer
   timers[buttonId] = setInterval(function() {
       var currentTime = parseInt(timeElement.textContent);
       timeElement.textContent = currentTime + 1;
   }, 1000);

   // Create a hidden input element, set its value to the buttonId, and append it to the form
   var input = document.createElement('input');
   input.type = 'hidden';
   input.name = 'button';
   input.value = buttonId;
   form.appendChild(input);

   // Submit the form
   form.submit();
}


</script>

@endsection
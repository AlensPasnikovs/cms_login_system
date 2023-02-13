@extends('layouts.app')

@section('content')



<div class="justify-content-center mx-4">
   <div class="col-md-12 p-3">
      @if ($message = Session::get('status'))
   <div class="alert alert-success alert-block mb-2">
      <strong>{{ $message }}</strong>
   </div>
   @endif
      <div class="card border shadow p-3 mb-4  rounded-3">
         @include('profile.partials.update-profile-information-form')
      </div>
      <div class="card border shadow p-3 mb-4  rounded-3">
         @include('profile.partials.update-password-form')
      </div>
      <div class="card border shadow p-3 mb-4  rounded-3">
         @include('profile.partials.delete-user-form')
      </div>
   </div>


</div>
@endsection

@section('scripts')
<script>
   var translations = @json(trans("js_translations"));
</script>
<script type="module" src="{{ asset('js/profile.js') }}"></script>

<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

{{-- {!! JsValidator::formRequest('App\Http\Requests\ProfileUpdateRequest', '#profile_info_form') !!}
{!! JsValidator::formRequest('App\Http\Requests\PasswordUpdateRequest', '#profile_password_form' ) !!}
{!! JsValidator::formRequest('App\Http\Requests\ProfileDeleteRequest', '#delete_account_form') !!} --}}

@endsection
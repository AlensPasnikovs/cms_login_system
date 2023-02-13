@if (count($errors->get('delete_password')) > 0)
<script type="text/javascript">
window.onload = () => {
   $('#deleteAccountModal').removeClass('fade');
   $('#deleteAccountModal').modal('show');
   $('#deleteAccountModal').addClass('fade');
}
</script>
@endif
<div class="card-body">
   <h4 class="">
      {{ __('messages.delete_account') }}
   </h4>
   <p class="mt-1 col-lg-6">
      {{ __('messages.delete_account_desc') }}
   </p>
   <button type="button" class="btn btn-danger px-4 mt-3" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
      {{ __('messages.delete_account_button') }}
   </button>



   <div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel"
      aria-hidden="true" role="dialog">
      <div class="modal-dialog">
         <div class="modal-content border-0">
            <div class="modal-body m-2">

               <!-- <div class="d-flex justify-content-between align-items-center"> -->
               <h5 class="modal-title mb-3" id="deleteAccountModalLabel">
                  {{ __('messages.delete_are_you_sure') }}
               </h5>
               <!-- <button type="button" class="btn-close mb-3" data-bs-dismiss="modal" aria-label="Close"></button> -->
               <!-- </div> -->
               <p class="">
                  {{ __('messages.delete_warning') }}
               </p>
               <form method="POST" id="delete_account_form" action="{{ route('profile.destroy') }}">
                  @csrf
                  @method('delete')
                  <div class="mb-3">
                     <div class="col-md-10 col-lg-8">
                        <input id="del_password" type="text" class="form-control  shadow-sm" name="delete_password" 
                        placeholder="{{ __('messages.password') }}" autofocus>
                        <ul class="text-danger my-2">
                           @foreach ($errors->get('delete_password') as $error)
                              <li>{{ $error }}</li>
                           @endforeach
                        </ul>
                     </div>
                  </div>
                  <div class="d-flex justify-content-end gap-3 ">
                     <button type="button" class="btn border text-dark-emphasis shadow-sm px-3"
                        data-bs-dismiss="modal">{{ __('messages.cancel_button') }}</button>
                     <button type="submit" class="btn btn-danger px-3">{{ __('messages.delete_account_button') }}</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>


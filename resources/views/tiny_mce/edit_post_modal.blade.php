<!-- Modal -->
<div class="modal fade" id="edit_post_modal" tabindex="-1" role="dialog" aria-labelledby="createPostModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-xl" style="min-width:80%;" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title ms-1">{{ __('messages.edit_post') }}</h5>
         <button type="button" class="btn-close fs-5 me-1" data-bs-dismiss="modal" aria-label="Close"></button>
       </div>
       <div class="modal-body">
         <form action="{{ route('update_post', '') }}" method="POST" enctype="multipart/form-data" id="update_post_form" class="needs-validation" novalidate>
           @csrf
           @method('PUT')
           {{-- <input type="hidden" name="post_id" id="update_post_id" value=""> --}}
           <div class="mb-2">
             <label for="post_title" class="ms-1 mb-1">{{ __('messages.post_title') }}</label>
             <input type="text" name="post_title" id="update_post_title" class="form-control" required>
             <div class="invalid-feedback">
                {{ __('validation.post_title_validation') }}
              </div>
           </div>
           <div class="mb-2">
             <label for="post_content" class="ms-1 mb-1">{{ __('messages.post_content') }}</label>
             <textarea name="post_content" id="update_post_content" style="z-index: 100000;" class="tinymce-textarea" required></textarea>
             <div class="invalid-feedback post_content">
                {{ __('validation.post_content_validation') }}
              </div>
           </div>
 
           <div class="mb-2">
             <label for="update_post_image" class="ms-1 mb-1">{{ __('messages.post_image') }}</label>
                <div class="input-group custom-file-button">
                  <label class="input-group-text" for="update_post_image" role="button">{{ __('messages.choose_file') }}</label>
                  <label for="update_post_image" class="form-control" id="update_post_image_label" role="button">{{ __('messages.no_file_chosen') }}</label>
                  <input type="file" class="d-none" id="update_post_image" name="post_image" accept="image/*">
                  <div class="invalid-feedback is-invalid">{{ __('validation.post_image_validation') }}</div>
                </div>
          </div>
          
          <button type="submit" class="btn border btn-dark text-whites px-4 mt-1 float-end btnSave" form="update_post_form">
             <span hidden="hidden" class="spinner-border spinner-border-sm loadingSpan" role="status"
             aria-hidden="true"></span>
             <span class="loadingText">{{ __('messages.save_button') }}</span>
          </button>
         </form>
       </div>
     </div>
   </div>
 </div>
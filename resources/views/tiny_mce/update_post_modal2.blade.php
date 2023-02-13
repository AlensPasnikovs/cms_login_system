<!-- Modal -->
<div class="modal fade" id="edit_post_modal" tabindex="-1" role="dialog" aria-labelledby="editPostModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" style="min-width:80%;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title ms-1" id="editPostModalLabel">{{ __('messages.edit_post') }}</h5>
        <button type="button" class="btn-close fs-5 me-1" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('update_post') }}" method="POST" enctype="multipart/form-data" id="edit_post_form" class="needs-validation" novalidate>
          @csrf
          <input type="hidden" name="post_id" id="post_id">
          <div class="mb-2">
            <label for="post_title" class="ms-1 mb-1">{{ __('messages.post_title') }}</label>
            <input type="text" name="post_title" id="post_title" class="form-control" required>
            <div class="invalid-feedback">
               {{ __('messages.post_title_validation') }}
             </div>
          </div>
          <div class="mb-2">
            <label for="post_content" class="ms-1 mb-1">{{ __('messages.post_content') }}</label>
            <textarea name="post_content" id="post_content" style="z-index: 100000;" required></textarea>
            <div class="invalid-feedback post_content">
               {{ __('messages.post_content_validation') }}
             </div>
          </div>
          <div class="mb-2">
            <label for="post_image" class="ms-1 mb-1">{{ __('messages.post_image') }}</label>
               <div class="input-group custom-file-button">
                 <label class="input-group-text" for="post_image" role="button">{{ __('messages.choose_file') }}</label>
                 <label for="post_image" class="form-control" id="post_image_label" role="button">{{ __('messages.no_file_chosen') }}</label>
                 <input type="file" class="d-none" id="post_image" name="post_image" accept="image/*">
                 <div class="invalid-feedback is-invalid">{{ __('messages.post_image_validation') }}</div>
               </div>
         </div>
         <
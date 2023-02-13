@extends('layouts.app')

@section('headScripts')
<script src="https://cdn.tiny.cloud/1/j99m3hzybcfd4631gg5p9d9mb5csjop9c73qkd99t3ixujt7/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
@endsection

@section('content')
  
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="col-md-12">
   @if (Auth::check())
   <div class="row">
      <div class="col-12">
         <button class="btn btn-success mb-3 float-end" data-bs-toggle="modal"
            data-bs-target="#createPostModal">{{__('messages.new_post');}}</button>
      </div>
   </div>
   @endif

<form action="{{ route('create_post') }}" method="POST" enctype="multipart/form-data" id="create_post_form">
   @csrf
   <div class="mb-2">
      <label for="post_title" class="ms-1 mb-1">{{ __('messages.post_title') }}</label>
      <input type="text" name="post_title" id="post_title" class="form-control">
   </div>
   <div class="mb-2">
      <label for="post_content" class="ms-1 mb-1">{{ __('messages.post_content') }}</label>
      <textarea name="post_content" id="post_content">
      
      </textarea>
   </div>

   <div class="mb-2" >
      <label for="post_image" class="ms-1 mb-1">{{ __('messages.post_image') }}</label>
      <div class="file-input-wrapper">
         <input class="file-input-real" type="file" accept="image/*"  name="post_image" id="post_image">
         <div class="file-input-text-wrapper">
            <button class="file-input-button" type="button">{{ __('messages.choose_file') }}</button>
           <input class="file-input-text" type="text" placeholder="{{ __('messages.no_file_chosen') }}" readonly>
         </div>
       </div>
   </div>

   
   
   <div class="d-flex justify-content-end mt-2">
      <button type="submit" class="btn bg-white border shadow-sm px-3"
      >{{ __('messages.save_button') }}</button>
   </div>
  

</form>


@include('tiny_mce.create_post_modal')




@endsection

@section('scripts')
<script>
   var translations = @json(trans("js_translations"));
   </script>
<script type="module" src="{{ asset('js/tinymce.js') }}"></script>

@endsection

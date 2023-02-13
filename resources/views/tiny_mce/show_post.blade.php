@extends('layouts.app')

@section('content')
      <div class="row">
         <div class="col-md-12">
            <div class="card">
               <div class="card-header">
                  <h3 class="mt-2">{{ $post->title }}</h3>
               </div>
               <div class="card-body post-content hyphens">
                  {!! $post->content !!}
               </div>
            </div>
         </div>
      </div>
   </div>
@endsection

@section('scripts')

<script>
   document.addEventListener('DOMContentLoaded', function () {
     var iframes = document.getElementsByTagName('iframe');
     for (var i = 0; i < iframes.length; i++) {
       var width = iframes[i].width;
       iframes[i].outerHTML = '<div class="video-container" style="width: ' + width + 'px; ">' + '<div class="ratio ratio-16x9">' + iframes[i].outerHTML + '</div>' + '</div>';
     }
   });

   $(window).on("popstate", function (event) {
        // reload the page content here
        console.log("popstate");
        $.get("getPosts", function (response) {
            // update the HTML with the new content
            $("#post_container").empty();
            $("#post_container").append(response.html);
        });
    });
</script>


@endsection

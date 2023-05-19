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
   function resizeIframes() {
  var iframes = document.querySelectorAll('.card-body iframe');
  iframes.forEach(function(iframe) {
    var width = iframe.offsetWidth;
    var height = width * 9 / 16;
    iframe.style.height = height + 'px';
  });
}

window.addEventListener('resize', resizeIframes);
resizeIframes();



   // document.addEventListener('DOMContentLoaded', function () {
   //   var iframes = document.getElementsByTagName('iframe');
   //   for (var i = 0; i < iframes.length; i++) {
   //     var width = iframes[i].width;
   //     iframes[i].outerHTML = '<div class="video-container" style="width: ' + width + 'px; ">' + '<div class="ratio ratio-16x9">' + iframes[i].outerHTML + '</div>' + '</div>';
   //   }
   // });

//    var iframes = document.querySelectorAll('.card-body iframe');
// iframes.forEach(function(iframe) {
//   var p = iframe.parentElement;
//   p.classList.add('ratio', 'ratio-16x9');
// });


// var iframes = document.querySelectorAll('.card-body iframe');
// iframes.forEach(function(iframe) {
//   var width = iframe.getAttribute('width');
//   iframe.style.maxWidth = width + 'px';
// });





   //    document.addEventListener('DOMContentLoaded', function () {
//   var iframes = document.getElementsByTagName('iframe');
//   for (var i = 0; i < iframes.length; i++) {
//     var width = iframes[i].width;
//     var parent = iframes[i].parentElement;
//     while (parent && parent.tagName !== 'P') {
//       parent = parent.parentElement;
//     }
//     var textAlign = parent ? window.getComputedStyle(parent).textAlign : '';
//     var float = window.getComputedStyle(iframes[i]).float;
//     var alignStyle = '';
//     if (float === 'right' || textAlign === 'right') {
//       alignStyle = ' margin-left: auto;';
//       iframes[i].style.float = 'none';
//     } else if (textAlign === 'center') {
//       alignStyle = ' margin: 0 auto;';
//     } else if (textAlign === 'left') {
//       alignStyle = ' margin-right: auto;';
//     }
//     iframes[i].outerHTML = '<div style="max-width: ' + width + 'px;' + alignStyle + '">' + '<div class="ratio ratio-16x9">' + iframes[i].outerHTML + '</div>' + '</div>';
//   }
// });





   // $(window).on("popstate", function (event) {
   //      // reload the page content here
   //      console.log("popstate");
   //      $.get("getPosts", function (response) {
   //          // update the HTML with the new content
   //          $("#post_container").empty();
   //          $("#post_container").append(response.html);
   //      });
   //  });
</script>


@endsection
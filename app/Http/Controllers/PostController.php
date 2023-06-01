<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller {
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   // public function index() {
   //    $posts = Post::all();
   //    return view('tiny_mce.index', compact('posts'));
   // }
   // public function posts() {
   //    $posts = Post::all();
   //    return view('tiny_mce.index', compact('posts'));
   // }

   public function redirectToSubdomain() {
      $user = auth()->user();
      // Check if the user has a subdomain.
      if (!empty($user->subdomain)) {
         // Generate a new token for this login session.
         $token = Str::random(32);
         DB::table('sso_tokens')->insert([
            'token' => $token,
            'user_id' => $user->id,
         ]);

         // Redirect to the user's container.
         return redirect("http://{$user->subdomain}.prakse.localhost/sso-entry?token={$token}");
      }

      // If the user doesn't have a container, redirect them to the default location.
      return redirect('/');
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create() {
      //
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(PostRequest $request) {
      $post = new Post();
      $post->title = $request->post_title;
      $post->content = $request->post_content;
      //image upload
      if ($request->hasFile('post_image')) {
         //get timestamp.image_original_name to avoid duplicate name
         $image = $request->file('post_image');
         $fileName = time() . '.' . $image->getClientOriginalName();
         $image->storeAs('public/photos/posts', $fileName);
         $post->image = $fileName;
      }
      $post->save();
      //redirect to posts page with success message
      return redirect()->route('tiny_mce')->with('success', __('validation.post_created'));
   }

   function getPostOrRedirect($id) {
      $post = Post::find($id);
      if (!$post) {
         abort(redirect()->route('tiny_mce')->withErrors(['error' => __('validation.post_not_found')]));
      }
      return $post;
   }

   /**
    * Display the specified resource.
    *
    * @param  \App\Models\Post  $post
    * @return \Illuminate\Http\Response
    */
   public function show($id) {
      $post = $this->getPostOrRedirect($id);
      return view('tiny_mce.show_post', compact('post'));
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Post  $post
    * @return \Illuminate\Http\Response
    */
   public function edit($id) {
      $post = $this->getPostOrRedirect($id);
      return response()->json([
         'title' => $post->title,
         'content' => $post->content,
         'image' => $post->image
      ]);
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Post  $post
    * @return \Illuminate\Http\Response
    */
   public function update(PostRequest $request, $id) {
      $post = $this->getPostOrRedirect($id);
      $post->title = $request->post_title;
      $post->content = $request->post_content;
      //image upload
      if ($request->hasFile('post_image')) {
         //get timestamp.image_original_name to avoid duplicate name
         $image = $request->file('post_image');
         $fileName = time() . '.' . $image->getClientOriginalName();
         $image->storeAs('public/photos/posts', $fileName);
         //delete the old image
         if ($post->image) {
            Storage::delete('public/photos/posts/' . $post->image);
         }
         $post->image = $fileName;
      }
      $post->save();
      return redirect()->route('tiny_mce')->with('success', __('validation.post_updated'));
   }


   /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Post  $post
    * @return \Illuminate\Http\Response
    */
   public function destroy($id) {
      $post = $this->getPostOrRedirect($id);
      Storage::delete('public/photos/posts/' . $post->image);
      $post->delete();
      return redirect()->route('tiny_mce')->with('success', __('validation.post_deleted'));
   }
}
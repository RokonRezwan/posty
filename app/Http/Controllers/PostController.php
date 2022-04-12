<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\PostValidationRequest;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->only(['store', 'destroy']);
    }

     public function index()
     {
         $posts = Post::latest()->with(['user', 'likes'])->paginate(20);

         return view('posts.index',[
             'posts' => $posts
         ]);
     }

      public function show(Post $post)
      {
          return view('posts.show',[
              'post' => $post
          ]);
      }

     public function store(PostValidationRequest $request)
     {
         $request->user()->posts()->create($request->only('body'));

         return back();
     }

     public function destroy(Post $post)
     {
         $this->authorize('delete', $post);

         $post->delete();

         return back();
     }
}

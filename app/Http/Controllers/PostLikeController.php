<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostLikeController extends Controller
{
    public function store(Post $post)
    {
        $post->likes()->create([
            'user_id' => $request->user()->id,
        ]);
    }
}

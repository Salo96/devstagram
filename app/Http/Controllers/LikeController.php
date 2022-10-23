<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class LikeController extends Controller
{
    public function store(Request $r, Post $post){
        // dd('like');
        // dd($post->id, $r->user()->id);

        $post->likes()->create([
            'user_id' => $r->user()->id
        ]);

        return back();

    }

    public function destroy(Request $r, Post $post){
        // dd('eliminado');
        $r->user()->likes()->where('post_id', $post->id)->delete();
        return back();
    }
}

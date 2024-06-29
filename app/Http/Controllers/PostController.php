<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class PostController extends Controller
{
    public function index(){
        $posts = Post::all();
        return view('projectPanel.posts.index' , compact('posts'));
    }
    public function create(){
        return view('projectPanel.posts.create');
    }
    public function addPost(Request $request){
        $post = new Post();
        $post->user_id = Auth::id();
        $post->title = $request->post_title;
        $post->content = $request->post_content;
        $post->save();
        redirect('projectLayout.posts.create');
    }
}

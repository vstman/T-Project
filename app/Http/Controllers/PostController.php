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
    public function upload(Request $request){
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;

            $request->file('upload')->move(public_path('media'), $fileName);

            $url = asset('media/' . $fileName);
            return response()->json(['fileName' => $fileName, 'uploaded'=> 1, 'url' => ($url)]);
        }
    } 
}


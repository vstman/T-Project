<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class PostController extends Controller
{
    public function index(){
        $posts = Post::paginate(12);
        return view('projectPanel.posts.index', compact('posts'));
    }
    public function admin_index(){
        return view('adminPanel.layout.app');
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
        return redirect()->route('admin.index');
    }

    public function edit($id){
        $post = Post::find($id);
        return view('adminPanel.edit', compact('post'));
    }

    public function update(Request $request, $id){
        $post = Post::find($id);
        $post->title = $request->post_title;
        $post->content = $request->post_content;
        $post->save();
        return redirect()->route('admin.index');
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

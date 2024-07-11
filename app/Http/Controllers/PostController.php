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
        $posts = Post::all();
        return view('adminPanel.index', compact('posts'));
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
    public function details($id){
        $post = Post::find($id);
        return view('projectPanel.posts.detail' , compact('post'));
    }
    public function admin_details($id){
        $post = Post::find($id);
        return view('adminPanel.detail' , compact('post'));
    }
    public function destroy($id)
{
    $post = Post::findOrFail($id);
    $post->delete();

    return redirect()->route('admin.index')->with('success', 'Başarıyla silindi.');
}
}

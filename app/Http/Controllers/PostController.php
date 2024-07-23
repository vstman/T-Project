<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\TeamMember;

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

    public function addPost(Request $request)
{
    $post = new Post();
    $post->supporting_organization = $request->supporting_organization;
    $post->project_title = $request->project_title;
    $post->project_code = $request->project_code;
    $post->supervisor = $request->supervisor;
    $post->department = $request->department;
    $post->duration = $request->duration;
    $post->budget = $request->budget;
    
    $post->save();

    // Ekibi kaydetmek için
    $teamMembers = [];
    foreach ($request->team_name as $key => $teamName) {
        $teamMembers[] = new TeamMember([
            'name' => $teamName,
            'position' => $request->team_position[$key],
            'department' => $request->team_department[$key],
        ]);
    }
    $post->teamMembers()->saveMany($teamMembers);

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
public function search(Request $request)
    {
        $query = $request->query('query');

        if ($query && strlen($query) >= 2) {
            $searchValues = preg_split('/\s+/', $query, -1, PREG_SPLIT_NO_EMPTY);
            $posts = Post::query();

            $posts->where(function($q) use ($searchValues) {
                foreach ($searchValues as $value) {
                    $q->orWhere('project_title', 'LIKE', "%{$value}%");
                }
            });

            $posts = $posts->paginate(6); // Sayfalama

            $data = [
                'pageTitle' => 'Search for :: ' . $request->query('query'),
                'posts' => $posts
            ];

            return view('projectPanel.posts.search', $data);
        } else {
            return abort(404);
        }
    }
}

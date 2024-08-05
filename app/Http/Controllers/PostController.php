<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Supervisor;
use App\Models\TeamMember;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(12);
        return view('projectPanel.posts.index', compact('posts'));
    }

    public function admin_index()
    {
        $posts = Post::all();
        return view('adminPanel.index', compact('posts'));
    }

    public function create()
    {
        return view('adminPanel.create');
    }

    public function addPost(PostRequest $request)
{
    try {
        // Create the Post
        $post = new Post();
        $post->supporting_organization = $request->input('supporting_organization');
        $post->project_title = $request->input('project_title');
        $post->project_code = $request->input('project_code');
        $post->duration = $request->input('duration');
        $post->budget = $request->input('budget');
        $post->save();

        // Process supervisors
        if ($request->has('supervisor_name')) {
            foreach ($request->input('supervisor_name') as $index => $name) {
                $supervisor = new Supervisor();
                $supervisor->post_id = $post->id;
                $supervisor->name = $name;
                $supervisor->department = $request->input('supervisor_department')[$index] ?? null;

                if ($request->hasFile("supervisor_photo.$index")) {
                    $file = $request->file("supervisor_photo.$index");
                    $filename = time() . '_' . $index . '.' . $file->getClientOriginalExtension();
                    $filePath = $file->storeAs('supervisor_photos', $filename, 'public');
                    $supervisor->supervisor_photo = 'storage/' . $filePath;
                } else {
                    $supervisor->supervisor_photo = 'storage/default-photo.png';
                }

                $supervisor->save();
            }
        }

        // Process team members
        if ($request->has('team_name')) {
            foreach ($request->input('team_name') as $key => $teamName) {
                $teamMember = new TeamMember();
                $teamMember->post_id = $post->id;
                $teamMember->name = $teamName;
                $teamMember->position = $request->input('team_position')[$key] ?? null;
                $teamMember->department = $request->input('team_department')[$key] ?? null;
                $teamMember->save();
            }
        }
        
        return redirect()->route('admin.index')->with('success', 'Post başarıyla oluşturuldu.');
    } catch (\Exception $e) {
        dd($e);
        Log::error('Error creating post: ' . $e->getMessage());
        return redirect()->back()->withErrors(['error' => 'An error occurred while creating the post.']);
    }
}
    

    
    public function edit($id)
    {
        $post = Post::find($id);
        return view('adminPanel.edit', compact('post'));
    }

    public function update(PostRequest $request, $id)
{

    $validated = $request->validated();

    $post = Post::find($id);
    
    if (!$post) {
        return redirect()->route('admin.index')->withErrors(['error' => 'Post bulunamadı.']);
    }

    // Post bilgilerini güncelle
    $post->supporting_organization = $validated['supporting_organization'];
    $post->project_title = $validated['project_title'];
    $post->project_code = $validated['project_code'];
    $post->duration = $validated['duration'];
    $post->budget = $validated['budget'];
    $post->save();

    // Süpervizörler işlemleri
    if (isset($request->supervisor_name)) {
        foreach ($request->supervisor_name as $index => $name) {
            $supervisorId = $request->supervisor_id[$index] ?? null;
            
            if ($supervisorId) {
                $supervisor = Supervisor::find($supervisorId);
            } else {
                $supervisor = new Supervisor();
                $supervisor->post_id = $post->id;
            }

            $supervisor->name = $name;
            $supervisor->department = $request->supervisor_department[$index] ?? null;

            if ($request->hasFile("supervisor_photo.$index")) {
                $file = $request->file("supervisor_photo.$index");
                $filename = time() . '_' . $index . '.' . $file->getClientOriginalExtension();
                $filePath = $file->storeAs('supervisor_photos', $filename, 'public');
                $supervisor->supervisor_photo = 'storage/' . $filePath;
            }

            $supervisor->save();
        }
    }

    // Ekip uyesi islemleri
    if (isset($request->team_name)) {
        $teamIds = $request->team_id ?? [];

        foreach ($request->team_name as $index => $teamName) {
            $teamId = $request->team_id[$index] ?? null;

            if ($teamId) {
                $teamMember = TeamMember::find($teamId);
                if (!$teamMember) {
                    $teamMember = new TeamMember();
                    $teamMember->post_id = $post->id;
                }
            } else {
                $teamMember = new TeamMember();
                $teamMember->post_id = $post->id;
            }

            $teamMember->name = $teamName;
            $teamMember->position = $request->team_position[$index] ?? null;
            $teamMember->department = $request->team_department[$index] ?? null;

            $teamMember->save();
            $teamIds[] = $teamMember->id;
        }

        TeamMember::where('post_id', $post->id)
                  ->whereNotIn('id', $teamIds)
                  ->forceDelete();
    }

    return redirect()->route('admin.index')->with('success', 'Post başarıyla güncellendi.');
}






    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;

            $request->file('upload')->move(public_path('media'), $fileName);

            $url = asset('media/' . $fileName);
            return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => ($url)]);
        }
    }

    public function details($id)
    {
        $post = Post::find($id);
        return view('projectPanel.posts.detail', compact('post'));
    }

    public function admin_details($id)
    {
        $post = Post::find($id);
        return view('adminPanel.detail', compact('post'));
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        TeamMember::where('post_id', $id)->delete();
        Supervisor::where('post_id' , $id)->delete();
        return redirect()->route('admin.index')->with('success', 'Başarıyla silindi.');
    }

    public function search(Request $request)
  {
    if ($request->ajax()) {
        $posts = Post::where('project_title', 'LIKE', '%'.$request->search.'%')
                     ->orWhere('supporting_organization', 'LIKE', '%'.$request->search.'%')
                     ->orWhere('project_code', 'LIKE', '%'.$request->search.'%')
                     ->get();

        $view = view('projectPanel.posts.partials.post-list', compact('posts'))->render();

        return response()->json(['html' => $view]);
    }
}
}

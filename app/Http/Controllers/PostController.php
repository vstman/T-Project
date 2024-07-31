<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\TeamMember;

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

    public function addPost(Request $request)
{
    // Verileri doğrulama
    $validated = $request->validate([
        'supporting_organization' => 'required|string|max:255',
        'project_title' => 'required|string|max:255',
        'project_code' => 'required|string|max:50',
        'supervisor' => 'required|string|max:255',
        'department' => 'required|string',
        'duration' => 'required|integer',
        'budget' => 'required|numeric',
        'supervisor_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'team_name' => 'required|array|min:1',
        'team_name.*' => 'required|string|max:255',
        'team_position.*' => 'nullable|string|max:255',
        'team_department.*' => 'nullable|string|max:255',
    ]);

    $post = new Post();
    $post->supporting_organization = $validated['supporting_organization'];
    $post->project_title = $validated['project_title'];
    $post->project_code = $validated['project_code'];
    $post->supervisor = $validated['supervisor'];
    $post->department = $validated['department'];
    $post->duration = $validated['duration'];
    $post->budget = $validated['budget'];

    // Resim dosyasını yükleme işlemi
    if ($request->hasFile('supervisor_photo')) {
        $file = $request->file('supervisor_photo');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $filePath = $file->storeAs('image', $filename, 'public');
        $post->supervisor_photo = '/storage/' . $filePath;
    }

    $post->save();

    $teamMembers = [];
    foreach ($validated['team_name'] as $key => $teamName) {
        $teamMembers[] = new TeamMember([
            'name' => $teamName,
            'position' => $validated['team_position'][$key] ?? null,
            'department' => $validated['team_department'][$key] ?? null,
        ]);
    }
    $post->teamMembers()->saveMany($teamMembers);

    return redirect()->route('admin.index')->with('success', 'Post başarıyla oluşturuldu.');
}


    public function edit($id)
    {
        $post = Post::find($id);
        return view('adminPanel.edit', compact('post'));
    }

    public function update(Request $request, $id)
{
    // Verileri doğrulama
    $validated = $request->validate([
        'supporting_organization' => 'required|string|max:255',
        'project_title' => 'required|string|max:255',
        'project_code' => 'required|string|max:50',
        'supervisor' => 'required|string|max:255',
        'department' => 'required|string',
        'duration' => 'required|integer',
        'budget' => 'required|numeric',
        'supervisor_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'team_name' => 'required|array|min:1',
        'team_name.*' => 'required|string|max:255',
        'team_position.*' => 'nullable|string|max:255',
        'team_department.*' => 'nullable|string|max:255',
    ]);

    $post = Post::find($id);

    $post->project_title = $validated['project_title'];
    $post->project_code = $validated['project_code'];
    $post->supporting_organization = $validated['supporting_organization'];
    $post->supervisor = $validated['supervisor'];
    $post->department = $validated['department'];
    $post->duration = $validated['duration'];
    $post->budget = $validated['budget'];


    if ($request->hasFile('supervisor_photo')) {

        if ($post->supervisor_photo) {
            $oldPhotoPath = public_path('storage/' . $post->supervisor_photo);
            if (file_exists($oldPhotoPath)) {
                unlink($oldPhotoPath);
            }
        }

        // Yeni resmi yükle
        $file = $request->file('supervisor_photo');
        if ($file->isValid()) {
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('uploads/supervisors', $filename, 'public');
            $post->supervisor_photo = 'storage/' . $filePath;
        }
    }

    $post->save();


    $post->teamMembers()->delete();


    if ($request->has('team_name')) {
        foreach ($request->team_name as $index => $name) {
            if (!empty($name)) {
                $post->teamMembers()->create([
                    'name' => $name,
                    'position' => $request->team_position[$index] ?? null,
                    'department' => $request->team_department[$index] ?? null,
                ]);
            }
        }
    }

    return redirect()->route('admin.index')->with('success', 'Post güncellendi.');
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

    // Handle non-AJAX requests if necessary
}

}

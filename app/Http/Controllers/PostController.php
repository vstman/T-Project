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

    public function edit($id)
    {
        $post = Post::find($id);
        return view('adminPanel.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $post->project_title = $request->project_title;
        $post->project_code = $request->project_code;
        $post->supporting_organization = $request->supporting_organization;
        $post->supervisor = $request->supervisor;
        $post->department = $request->department;
        $post->duration = $request->duration;
        $post->budget = $request->budget;

        $post->save();

        // Mevcut takım üyelerini sil
        $post->teamMembers()->delete();

        // Yeni takım üyelerini ekle
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
        $query = $request->query('query');

        // Boş veya 1 karakterden kısa sorguları kontrol et
        if (empty($query) || strlen($query) < 2) {
            return view('projectPanel.posts.search', [
                'pageTitle' => 'Arama Sonuçları',
                'posts' => new \Illuminate\Pagination\LengthAwarePaginator([], 0, 6) // Boş sayfalama nesnesi
            ]);
        }

        $searchValues = preg_split('/\s+/', $query, -1, PREG_SPLIT_NO_EMPTY);
        $postsQuery = Post::query();

        $postsQuery->where(function($q) use ($searchValues) {
            foreach ($searchValues as $value) {
                $q->orWhere('project_title', 'LIKE', "%{$value}%");
            }
        });

        $posts = $postsQuery->paginate(6); // Sayfalama

        $data = [
            'pageTitle' => 'Search for :: ' . $request->query('query'),
            'posts' => $posts
        ];

        return view('projectPanel.posts.search', $data);
    }

}

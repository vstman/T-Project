<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserCreationRequest;
use App\Http\Requests\UserUpdateRequest;


class UserController extends Controller
{
    public function index()
    {
        $users = User::all(); // Fetch all users
        $roles = Role::all(); // Fetch all roles
        return view('adminPanel.users.index', compact('users', 'roles'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('adminPanel.users.create', compact('roles'));
    }

    public function store(UserCreationRequest $request)
    {
        $validated = $request->validated();

        $user = new User();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['password']);
        $user->role_id = $validated['role_id'];
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Kullanıcı başarıyla oluşturuldu.');
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Kullanıcı başarıyla silindi.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('adminPanel.users.update', compact('user', 'roles'));
    }

    public function update(UserUpdateRequest $request, $id) // Use UserUpdateRequest here
    {
        $user = User::findOrFail($id);

        $validated = $request->validated(); // Validate the request

        $user->email = $validated['email'];
        $user->role_id = $validated['role_id'];
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Kullanıcı başarıyla güncellendi.');
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class AuthManager extends Controller
{
    function login()
    {
        return view('adminPanel.login');
    }

    function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credidentals = $request->only('email', 'password');
        if (Auth::attempt($credidentals)) {
            return redirect()->intended(route('admin.admin_index'));
        }
        return redirect(route('login'))->with('error', 'Girilen bilgiler doğru değil!');
    }

    function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('login');
    }


    public function registration()
    {
        return view('adminPanel.register');
    }

    function registrationPost(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);

        $user = User::create($data);
        if (!$user) {
            return redirect(route('register'));
        }
        return redirect(route('login'));
    }
}

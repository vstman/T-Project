<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;




class AuthManager extends Controller
{
    function login(){
        return view('adminPanel.login');
    }
    
    function loginPost(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credidentals = $request -> only('email' , 'password');
        if(Auth::attempt($credidentals)){
            return redircect()->intended(route('admin.posts.create'));            
        }
        return redirect(route('login'))->with(dd(1), "Girilen bilgiler doğru değil!");
    }

    function logout(){
        Session::flush();
        Auth::logout;
        return redirect(route('login'));
    }

    public function registration(){
        return view('adminPanel.register');
    }

    function registrationPost(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);
    
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
    
        $user = User::create($data);
        if(!$user){
            return redirect(route('register'));
        }
        return redirect(route('login'));
    }
}

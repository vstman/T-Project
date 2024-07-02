<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthManager extends Controller
{
    function login(){
        return view();
    }
    
    function loginPost(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credidentals = $request -> only('email' , 'password');
        if(Auth::attempt($credidentals)){
            return redircect()->intended(route('admin'))->with("success" , "Giriş yapıldı.");            
        }
        return redirect(route('login'))->with("error" , "Girilen bilgiler doğru değil!");
    }
}

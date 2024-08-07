<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // đăng nhập
    public function showFormLogin(){
        return view('auth.login');
    }

    public function login(Request $request){
        $user = $request->only('email','password');
        if(Auth::attempt($user)){
            return redirect()->intended('home');
        }
        return redirect()->back()->withErrors([
            'email'=>'Thông tin người dùng không đúng'
        ]);
    }

    // đăng ký
    public function showFormRegister(){
        return view('auth.register');
        
    }

    public function register(Request $request){
        $data = $request->validate([  
            'name'=>'required|string|max:255',
            'email'=>'required|string|email|max:255',
            'password'=>'required|string|min:8|max:255',
        ]);
        // dd($data);
        $user = User::query()->create($data);
        Auth::login($user);

        return redirect()->intended('login');
    }

    // đăng xuất
    public function logout(Request $request){
        Auth::logout();
        return redirect('/login');
    }
}

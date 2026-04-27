<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister() {
        return view('auth.register');
    }

    public function register(Request $request) {
        // $request->validate([
        //     'name'=>'required',
        //     'email'=>'required|email:rfc|unique:users',
        //     'password'=>'required|min:6'
        // ]);
        $validated = $request->validate([
            'name'=>'required|min:3|max:100',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:6'
        ]);


        // User::create([
        //     'name'=>$request->name,
        //     'email'=>$request->email,
        //     'password'=>Hash::make($request->password)
        // ]);

        $user =  User::create([
            'name'=>strip_tags($validated['name']),
            'email'=>$validated['email'],
            'password'=>Hash::make($validated['password'])
        ]);

        // assign default role
        $user->assignRole('user');


        // return redirect('/login');
         return redirect('/login')->with('success','Account created successfully');
    }

    public function showLogin() {
        return view('auth.login');
    }

    public function login(Request $request) {

        //  $request->validate([
        //     'email'=>'required|email',
        //     'password'=>'required'
        // ]);

        //  if(Auth::attempt($request->only('email','password'))) {
        //     return redirect('/tasks');
        // }

        // return back()->with('error','Invalid credentials')->withInput();

        $credentials = $request->only('email','password');

        $user = User::where('email',$request->email)->first();
        // dd($user);
        if ($user && $user->trashed()) {
            return back()->with('error','Account disabled');
        }

        if(Auth::attempt($credentials)) {
            // return redirect('/tasks');
            return redirect()->intended('/blogs');
        }

        return back()->with('error','Invalid credentials')->withInput();

    }

    public function logout() {
        Auth::logout();
        return redirect('/');
    }
}
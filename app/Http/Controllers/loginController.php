<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Auth;

class loginController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect('home');
        } else{
            return view('login.index');
        }
    }

    public function actionLogin(Request $request)
    {
        $data = [
            'username' => $request->input('username'),
            'password' => $request->input('password'),
        ];

        if (Auth::Attempt($data)) {
            return redirect('home');
        } else{
            Session::flash('error', 'Username atau Password Salah');
            return redirect('/');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}

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
            return view('login.index-new');
        }
    }

    public function actionLogin(Request $request)
    {
        $data = [
            'nik' => $request->input('nik'),
            'password' => $request->input('password'),
        ];

        if (Auth::Attempt($data)) {
            return redirect('home');
        } else{
            Session::flash('error', 'NIK atau Password Salah');
            return redirect('/');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}

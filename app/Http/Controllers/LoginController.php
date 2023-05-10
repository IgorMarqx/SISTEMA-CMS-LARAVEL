<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index(Request $r)
    {
        return view('admin.login');
    }

    public function login_action(Request $r)
    {
        $validator = Validator::make($r->all(), [
            'email' => 'required|email|max:100|',
            'password' => 'required|min:4|string|',
            'remember'
        ]);

        $data = $r->only('email', 'password', 'remember');

        if (Auth::attempt($data)) {
            return redirect()->route('admin');
        } else {
            $validator->errors()->add('password', 'Email ou senha incorretos!');

            return redirect()->route('login')
                ->withErrors($validator)
                ->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function index()
    {
        return view('admin.register');
    }

    public function register_action(Request $r)
    {
        $r->validate([
            'name' => 'required|max:100',
            'email' => 'required|email|max:100|unique:users',
            'password' => 'required|min:4|string|confirmed'
        ]);

        $data = $r->only('name', 'email', 'password', 'password_confirmation');
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);
        Auth::login($user);
        return (redirect(route('admin')));
    }
}

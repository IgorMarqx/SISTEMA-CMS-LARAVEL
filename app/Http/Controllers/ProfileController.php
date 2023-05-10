<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $loggedId = intval(Auth::id());

        $user = User::find($loggedId);

        if ($user) {
            return view('admin.profile.index', [
                'user' => $user,
            ]);
        }

        return redirect()->route('admin');
    }

    public function save(Request $request)
    {
        $loggedId = intval(Auth::id());
        $user = User::find($loggedId);

        if ($user) {
            $data = $request->only(
                'name',
                'email',
                'password',
                'password_confirmation'
            );

            $validator = Validator::make(
                [
                    'name' => $data['name'],
                    'email' => $data['email'],
                ],
                [
                    'name' => ['required', 'max:100', 'string'],
                    'email' => ['required', 'max:100', 'string', 'email'],
                ]
            );

            if ($validator->fails()) {
                return redirect()->route('users.edit', ['user' => $loggedId])->withErrors($validator);
            }

            $user->name = $data['name'];

            if ($user->email !== $data['email']) {
                $hasEmail = User::where('email', $data['email'])->get();

                if (count($hasEmail) === 0) {
                    $user->email = $data['email'];
                } else {
                    $validator->errors()->add('email', 'Já possui email cadastrado');
                }
            }

            if (!empty($data['password'])) {
                if (strlen($data['password']) >= 4) {
                    if ($data['password'] === $data['password_confirmation']) {
                        $user->password = Hash::make($data['password']);
                    } else {
                        $validator->errors()->add('password', 'Senhas não correspondem');
                    }
                } else {
                    $validator->errors()->add('password', 'Campo de senha precisa ter no minimo 4 caracteres');
                }
            }

            if (count($validator->errors()) > 0) {
                return redirect()->route('profile', ['user' => $loggedId])->withErrors($validator);
            }


            $user->save();
            session()->flash('success', 'Alterado com sucesso');
        }

        return redirect()->route('profile');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:edit-users');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $r)
    {
        $usuarios = User::paginate(10);
        $loggedId = intval(Auth::id());

        return view('admin.users.index', [
            'users' => $usuarios,
            'loggedId' => $loggedId
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->only([
            'name',
            'email',
            'password',
            'password_confirmation',
        ]);

        $validator = Validator::make(
            $data,
            [
                'name' => ['required', 'string', 'max:100'],
                'email' => ['required', 'string', 'email', 'max:100', 'unique:users'],
                'password' => ['required', 'string', 'min:4', 'confirmed'],
            ],

            [
                'name.required' => 'Preencha o campo nome.',

                'email.required' => 'Preencha o campo e-mail.',
                'email.unique' => 'Já existe um e-mail cadastrado.',
                'email.email' => 'Preencha um e-mail válido.',

                'password.required' => 'Preencha o campo senha.',
                'password.min' => 'Minimo de 4 caracteres.',
                'password.confirmed' => 'Senhas não se parecem.',
            ]
        );

        if ($validator->fails()) {
            return redirect()
                ->route('users.create')
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $user->save();

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);

        if ($user) {
            return view('admin.users.edit', [
                'user' => $user
            ]);
        }

        return redirect()->route('users.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);

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
                return redirect()->route('users.edit', ['user' => $id])->withErrors($validator);
            }

            $user->name = $data['name'];

            if ($user->email !== $data['email']) {
                $hasEmail = User::where('email', $data['email'])->get();

                if (count($hasEmail) === 0) {
                    $user->email = $data['email'];
                } else {
                    $validator->errors()->add('email', 'Já possui e-mail cadastrado');
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
                return redirect()->route('users.edit', ['user' => $id])->withErrors($validator);
            }


            $user->save();
        }

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $r, string $id)
    {
        $loggedId = intval(Auth::id());

        if ($loggedId != intval($id)) {
            $user = User::find($id);
            $user->delete();
        }


        return redirect()->route('users.index');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:edit-users');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $pages = Page::paginate(10);

        return view('admin.page.index', [
            'pages' => $pages,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.page.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = $request->only('title', 'body');

        $data['slug'] = Str::slug($data['title'], '-');

        $validator = Validator::make(
            $data,
            [
                'title' => ['required', 'max:100', 'string'],
                'body' => 'string',
                'slug' => ['required', 'string', 'max:100', 'unique:pages']
            ],
            [
                'title.required' => 'Preencha o campo.',
                'title.max' => 'Máximo 255 caracteres.',

                'slug.unique' => 'Nome já existente.'
            ]

        );

        if ($validator->fails()) {
            return redirect()->route('pages.create')
                ->withErrors($validator)
                ->withInput();
        }

        $page = new Page;
        $page->title = $data['title'];
        $page->slug = $data['slug'];
        $page->body = $data['body'];
        $page->save();

        return redirect()->route('pages.index');
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
        $page = Page::find($id);


        if ($page) {
            return view('admin.page.edit', [
                'page' => $page,
            ]);
        }

        return redirect()->route('pages.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $page = Page::find($id);
        $data = $request->only('title', 'body');

        if ($page) {
            $data = $request->only(
                'title',
                'body',
            );

            if ($page['title'] !== $data['title']) {
                $data['slug'] = Str::slug($data['title'], '-');

                $validator = Validator::make(
                    $data,
                    [
                        'title' => ['required', 'max:100', 'string'],
                        'body' => 'string',
                        'slug' => ['required', 'string', 'max:100', 'unique:pages']
                    ]
                );
            } else {
                $validator = Validator::make(
                    $data,
                    [
                        'title' => ['required', 'max:100', 'string'],
                        'body' => 'string',
                    ]
                );
            }

            if ($validator->fails()) {
                return redirect()->route('pages.edit', ['page' => $id])
                    ->withErrors($validator)
                    ->withInput();
            }

            $page->title = $data['title'];
            $page->body = $data['body'];

            if (!empty($data['slug'])) {
                $page->slug = $data['slug'];
            }

            $page->save();
        }


        session()->flash('success', 'Alterado com sucesso');
        return redirect()->route('pages.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if ($id) {
            $page = Page::find($id);
            $page->delete();
        }

        session()->flash('success', 'Deletado com sucesso');
        return redirect()->route('pages.index');
    }
}

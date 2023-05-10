<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:edit-users');
    }

    public function index(Request $request)
    {
        $settings = [];

        $dbsettings = Setting::get();

        foreach ($dbsettings as $dbsetting) {
            $settings[$dbsetting['name']] = $dbsetting['content'];
        }

        return view('admin.setting.index', [
            'settings' => $settings
        ]);
    }

    public function save(Request $request)
    {
        $data = $request->only([
            'title',
            'subtitle',
            'email',
            'bgcolor',
            'textcolor'
        ]);

        $validator = $this->validator($data);

        if ($validator->fails()) {
            return redirect()->route('settings')
                ->withErrors($validator)
                ->withInput();
        }

        foreach ($data as $item => $value) {
            Setting::where('name', $item)->update([
                'content' => $value
            ]);
        }

        session()->flash('success', 'Informações alteradas com sucesso!');
        return redirect()->route('settings');
    }

    protected function validator($data)
    {
        return Validator::make($data, [
            'title' => ['string', 'max:100'],
            'subtitle' => ['string', 'max:100'],
            'email' => ['string', 'email'],
            'bgcolor' => ['string', 'regex:/#[A-Za-z0-9]{6}/i'],
            'textcolor' => ['string', 'regex:/#[A-Za-z0-9]{6}/i']
        ]);
    }
}

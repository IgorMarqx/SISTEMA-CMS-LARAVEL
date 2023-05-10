<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\User;
use App\Models\Visitor;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $visitsCount = 0;
        $onlineCount = 0;
        $pageCount = 0;
        $userCount = 0;

        // Count visits
        $visitsCount = Visitor::count();

        // Count users online
        $datelimit = date('Y-m-d H:i:s', strtotime('-5 minutes'));
        $onlineList = Visitor::select('ip')->where('date_access', '>=', $datelimit)->groupBy('ip')->get();
        $onlineCount = count($onlineList);

        // Count pages
        $pageCount = Page::count();

        // Count users
        $userCount = User::count();

        $userPie = [];
        $userAll = User::selectRaw('name, count(name) as n')->groupBy('id')->get();
        foreach ($userAll as $user) {
            $userPie[$user['name']] = intval($user['n']);
        }

        // Contagem pagePIe
        $pagePie = [];
        $visitsAll = Visitor::selectRaw('page, count(page) as c')->groupBy('page')->get();
        foreach ($visitsAll as $visit) {
            $pagePie[$visit['page']] = intval($visit['c']);
        }

        $userValues = json_encode(array_values($userPie));
        $userLabels = json_encode(array_keys($userPie));

        $pageLabels = json_encode(array_keys($pagePie));
        $pageValues = json_encode(array_values($pagePie));

        return view('admin.home', [
            'visitsCount' => $visitsCount,
            'onlineCount' => $onlineCount,

            'pageCount' => $pageCount,
            'userCount' => $userCount,

            'pageLabels' => $pageLabels,
            'pageValues' => $pageValues,

            'userValues' => $userValues,
            'userLabels' => $userLabels,
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MenuController extends Controller
{

    public function index()
    {
        $meja = Session::get('meja')->nama;
        return view('menu', [
            'menus' => Menu::all(),
            'meja' => $meja,
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class DashboardPenjualanController extends Controller
{

    public function index()
    {
        return view('admin.pages.penjualan.index', [
            'all_menu' => Menu::latest()->get(),
        ]);
    }
}

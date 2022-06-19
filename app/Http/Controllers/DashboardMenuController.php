<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class DashboardMenuController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.item.index', [
            'all_menu' => Menu::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.item.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'kategori' => 'required',
            'harga' => 'required',
            'gambar' => 'image|file|max:4096',
        ]);

        if ($request->file('image')) {
            $validated['gambar'] = $request->file('image')->store('foto-deluna');
        }
        $validated['status'] = 'tersedia';

        Menu::create($validated);

        return redirect()->to('/admin/item');
        // return $request;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // if (request()->ajax()) {
        $menu = Menu::select(['nama', 'kategori', 'status'])->where('id', $id)->first();
        return $menu;
        // } else {
        //     abort(404);
        // }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu = Menu::where('id', $id)->get();

        return view('admin.pages.item.edit', [
            'menu' => $menu
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'nama' => 'required|max:255',
            'kategori' => 'required',
            'gambar' => 'image|file|max:4096',
            'harga' => 'required',
        ];

        $validated = $request->validate($rules);

        if ($request->file('gambar')) {
            Storage::delete($request->gambar);
            $validated['gambar'] = $request->file('gambar')->store('foto-deluna');
        }
        $validated['id'] = $id;
        Menu::where('id', $id)->update($validated);

        return redirect('/admin/item');
    }

    public function updateStatusMenu($id, $status)
    {
        if ($status == 'tersedia') {
            Menu::where('id', $id)->update(['status' => 'habis']);
        }
        if ($status == 'habis') {
            Menu::where('id', $id)->update(['status' => 'tersedia']);
        }

        return redirect()->to('/admin/item')->with('success', 'dsdsdsds');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = Menu::select('gambar')->where('id', $id)->first();
        Storage::delete($menu->gambar);
        $isSuccess = Menu::destroy($id);

        if ($isSuccess) {
            Alert::success('Success', 'menu berhasil dihapus');
            return redirect()->to('/admin/item');
        } else {
            Alert::error('Failed', 'menu gagal di hapus');
            return redirect()->to('/admin/item');
        }
    }
}

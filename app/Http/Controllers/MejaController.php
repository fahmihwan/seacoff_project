<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Ramsey\Uuid\Uuid;
use RealRashid\SweetAlert\Facades\Alert;

class MejaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $meja =  Meja::latest()->get();

        return view('admin.pages.meja.index', [
            'qrcode' => Meja::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.pages.meja.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $qrcode =   Uuid::uuid4()->toString();
        $currentDate = Carbon::now()->toDateString();
        $validated = $request->validate([
            'nama' => 'required',
        ]);
        $validated['qrcode'] = $qrcode . $currentDate;

        Meja::create($validated);
        return redirect()->to('/admin/setting/meja');




        // $enkripsi = Crypt::encryptString($request->nama . $currentDate);
        // $validated = $request->validate([
        //     'nama' => 'required',
        // ]);
        // $validated['qrcode'] =  $enkripsi;  //URL HARUS DI UBAH

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    public function show(Meja $meja)
    {

        return view('admin.pages.meja.show', [
            'meja' => $meja,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $isSuccess = Meja::destroy($id);

        if ($isSuccess) {
            Alert::success('Success', 'meja berhasil di hapus');
            return redirect()->to('/admin/setting/meja');
        } else {
            Alert::error('Failed', 'meja berhasil di hapus');
            return redirect()->to('/admin/setting/meja');
        }
    }
}

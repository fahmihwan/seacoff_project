<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.index');
    }

    public function list()
    {

        return view('admin.pages.akun.index', [
            'users' => User::all()
        ]);
    }

    public function authenticate(Request $request)
    {

        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/admin/dashboard');
        }

        return back()->with('loginError', 'Login failed!');
    }

    public function registerasi()
    {

        return view('admin.pages.akun.create');
    }

    public function store(Request $request)
    {
        $validatedData =  $request->validate([
            'nama' => 'required|max:255',
            'username' => ['required', 'min:3', 'max:255', 'unique:users'],
            'hak_akses' => 'required|in:admin,user',
            'password' => 'required|min:8|regex:#(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])#',

        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        $isSuccess =  User::create($validatedData);
        $this->alertFunction($isSuccess, 'akun berhasil di tambahkan', 'akun gagal ditambahkan');
        return redirect()->to('/admin/setting/akun');
    }



    public function edit($id)
    {

        dd($id);
        return view('admin.pages.akun.edit');
    }


    public function update()
    {
    }

    public function destroy($id)
    {

        $admin = User::select('hak_akses')->where('hak_akses', 'admin');

        if ($admin->count() == 1) {
            if (User::select('hak_akses')->where('hak_akses', 'admin')->where('id', $id)->count()) {
                Alert::error('Failed', 'sisakan minimal 1 akun admin');
            } else {
                $isSuccess = User::destroy($id);
                $this->alertFunction($isSuccess, 'akun berhasil di hapus', 'akun berhasil di hapus');
            }
        } else {
            $isSuccess = User::destroy($id);
            $this->alertFunction($isSuccess, 'akun berhasil di hapus', 'akun gagal di hapus');
        }

        return redirect()->to('/admin/setting/akun');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    protected function alertFunction($isSuccess, $success, $error)
    {
        if ($isSuccess) {
            Alert::success('Success', $success);
        } else {
            Alert::error('Failed', $error);
        }
    }
}

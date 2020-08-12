<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Hash;
use Log;
use RealRashid\SweetAlert\Facades\Alert;


class LoginController extends Controller
{
    public function index()
    {
        return redirect('/jurnal');
    }

    public function login()
    {
        if (Auth::user()) {
            return redirect('/jurnal');
        }
        else{
            return view('Auth.login');
        }
    }

    public function loginp(Request $req)
    {
        $this->validate($req,[
            'name' => 'required',
            'password' => 'required'
        ]);
        $user = [
            'name' => $req->name,
            'password' => $req->password,
        ];
        if (Auth::attempt($user)) {
            return redirect('/jurnal');
        }
        else{
            alert()->error('','Cek Kembali Username dan Password')->background('#3B4252')->autoClose(1700);
            return redirect()->back();
        };
    }

    public function signup(Request $req)
    {
        $validate = $req->validate([
            'username' => 'required',
            'kelas' => 'required',
            'pass' => 'required',
            'pass1' => 'same:pass'
        ]);

        $user = new User();
        $user->name = $req->username;
        $user->email = 'ketua@gmail.com';
        $user->password = Hash::make($req->pass);
        $user->role = 1;
        $user->kelas_id = $req->kelas;

        $valid = User::where('kelas_id',$req->kelas)->first();

        if ($valid == null) {
            $user->save();
            alert()->success('','User Berhasil Terdaftar')->background('#3B4252')->autoClose(1700);
        }
        else {
            alert()->error('','Proses Pendafataran Gagal, Ketua Kelas Sudah Terdaftar')->background('#3B4252')->autoClose(1700);
        }
        return redirect()->back();
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}

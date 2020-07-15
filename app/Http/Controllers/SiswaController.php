<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Siswa;
use App\Kelas;
use Auth;
use Arr;
class SiswaController extends Controller
{
    public function index()
    {
        //For User
        $role = Auth::user()->role;
        $kelas = Auth::user()->kelas_id;
        $cls = Kelas::all();
        $kls = Kelas::find($kelas);
        if ($role == 1) {
            $usr = Auth::user()->kelas_id;
            $siswa = Siswa::where('kelas_id','=',$usr)->orderBy('kelas_id', 'asc')->with('kelas')->simplePaginate(10);
            return view('Siswa.index',compact('siswa','kls','cls'));
        }
        else{
            return redirect('/siswa/0');
        }
    }

    public function kelas(Request $req,$kelas)
    {
        //For Admin
        $src = $req->search;
        $cls = Kelas::all();
        if ($kelas == "0") {
            $kls = Kelas::all();
        } else {
            $kls = Kelas::where('id','=',$kelas )->get()->toArray();
        }
        // $collect = collect($kls)->toArray();
        // $collect = Arr::pluck($collect,'id');
        if ($req->has('search')) {
            $siswa = Siswa::where('nama', 'LIKE', '%' . $src . '%')->orWhere('id', 'LIKE', '%' . $src . '%')->whereIn('kelas_id',$kls)->with('kelas')->simplePaginate(10);
            $siswa->appends(['search' => $src]);
        }
        else{
            $siswa = Siswa::whereIn('kelas_id',$kls)->orderBy('kelas_id', 'asc')->with('kelas')->simplePaginate(10);
        }
        return view('Siswa.index',compact('siswa','src','cls'));
    }
    public function createp(Request $req)
    {
        $this->validate($req,[
            'nama' => 'required',
            'kelas_id' => 'required'
        ]);
        $siswa = new Siswa($req->all());
        $siswa->save();
        return redirect('/siswa/0');
    }
    public function edit(Siswa $id)
    {
        $cls = Kelas::all();
        return view('Siswa.edit',compact('id','cls'));

    }
    public function editp(Request $req,Siswa $id)
    {
        $this->validate($req,[
            'nama' => 'required',
            'kelas_id' => 'required'
        ]);
        $id->fill($req->all());
        $id->save();
        return redirect('/siswa/0');
    }
    public function delete(Siswa $id)
    {
        $id->delete();
        return redirect('/siswa/0');
    }

}

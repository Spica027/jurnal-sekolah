<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Guru;
use Illuminate\Support\Str;

class GuruController extends Controller
{
    public function index(Request $req)
    {
        $src=$req->search;
        if ($req->has('search')) {
            $guru = Guru::where('nama', 'LIKE', '%' . $req->search . '%')->orWhere('kode', 'LIKE', '%' . $req->search . '%')->simplePaginate(10);
            $guru->appends(['search' => $src]);
        } else {
            $guru = Guru::simplePaginate(10);
        }
        return view('Guru.index',compact('guru','src'));
    }
    public function createp(Request $req)
    {
        $validation = $this->validate($req,[
            'nama' => 'required',
            'kode' => 'required|min:3'
        ]);
        $guru = new Guru($req->all());
        $guru->save();
        return redirect('/guru')->with(['success'=>'Data Guru Berhasil Ditambahkan']);
    }
    public function edit(Guru $id)
    {
        return view('Guru.edit',compact('id'));

    }
    public function editp(Request $req,Guru $id)
    {
        $this->validate($req,[
            'nama' => 'required',
            'kode' => 'required'
        ]);
        $id->fill($req->all());
        $id->save();
        return redirect('/guru');
    }
    public function delete(Guru $id)
    {
        $id->delete();
        return redirect('/guru')->with(['error'=>'Data Guru Berhasil Dihapus']);
    }
}

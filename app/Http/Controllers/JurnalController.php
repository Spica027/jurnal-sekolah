<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Jurnal;
use App\Mapel;
use App\Kelas;
use App\Siswa;
use Auth;
use Arr;
use App\Guru;
use Carbon\Carbon;
use PDF;
use DB;
class JurnalController extends Controller
{
    private $jamke;
    public function __construct(){
        $dt = Carbon::now();
        $hari = $dt->isoFormat('dddd');
        if ($hari == "Saturday" | $hari == "Sunday") {
            $this->jamke = 'home';
        }
        elseif ($hari == "Friday") {
            $jam = $dt->isoFormat('HHmm');
            if ($jam > '0700' & $jam <= '0745') {
                $this->jamke = 1;
            }
            elseif ($jam > '0745' & $jam <= '0830') {
                $this->jamke = 2;
            }
            elseif ($jam > '0830' & $jam <= '0915') {
                $this->jamke = 3;
            }
            elseif ($jam > '0915' & $jam <= '0930') {
                $this->jamke = "break";
            }
            elseif ($jam > '0930' & $jam <= '1015') {
                $this->jamke = 4;
            }
            elseif ($jam > '1015' & $jam <= '1100') {
                $this->jamke = 5;
            }
            elseif ($jam > '1100' & $jam <= '1145') {
                $this->jamke = 6;
            }
            elseif ($jam > '1145' & $jam <= '1215') {
                    $this->jamke = "break";
            }
            elseif ($jam > '1215' & $jam <= '1300') {
                $this->jamke = 7;
            }
            elseif ($jam > '1300' & $jam <= '1340') {
                $this->jamke = 8;
            }
            else {
                $this->jamke = "home";
            }
        }
        else{
            $jam = $dt->isoFormat('HHmm');
            if ($jam > '0700' & $jam <= '0745') {
                if ($hari == "Monday") {
                    $this->jamke = "break";
                }
                else{
                    $this->jamke = 1;
                }
            }
            elseif ($jam > '0745' & $jam <= '0830') {
                if ($hari == "Monday") {
                    $this->jamke = "break";
                }
                else{
                    $this->jamke = 2;
                }
            }
            elseif ($jam > '0830' & $jam <= '0915') {
                $this->jamke = 3;
            }
            elseif ($jam > '0915' & $jam <= '0930') {
                $this->jamke = "break";
            }
            elseif ($jam > '0930' & $jam <= '1015') {
                $this->jamke = 4;
            }
            elseif ($jam > '1015' & $jam <= '1100') {
                $this->jamke = 5;
            }
            elseif ($jam > '1100' & $jam <= '1145') {
                $this->jamke = 6;
            }
            elseif ($jam > '1145' & $jam <= '1215') {
                    $this->jamke = "break";
            }
            elseif ($jam > '1215' & $jam <= '1300') {
                $this->jamke = 7;
            }
            elseif ($jam > '1300' & $jam <= '1340') {
                $this->jamke = 8;
            }
            elseif ($jam > '1340' & $jam <= '1420') {
                $this->jamke = 9;
            }
            elseif ($jam > '1420' & $jam <= '1500') {
                $this->jamke = 10;
            }
            elseif ($jam > '1500' & $jam <= '1515') {
                $this->jamke = "break";
            }
            elseif ($jam > '1515' & $jam <= '1600') {
                $this->jamke = 11;
            }
            else {
                $this->jamke = "home";
            }
        }
    }

    public function index(Request $req,Jurnal $jurnal)
    {
        $dt =Carbon::now();
        $today = $dt->toDateString();
        $mpl = Mapel::orderBy('mapel','asc')->get();
        $gr = Guru::all();
        $cls = Kelas::all();
        $kelas = Auth::user()->kelas_id;
        $kls = Kelas::find($kelas);
        $siswa = Siswa::where('kelas_id','=',$kelas)->get();
        $guru = Auth::user()->guru_id;
        if (Auth::user()->role == 1){
            if ($req->has('date') ) {
                $jurnal = Jurnal::with('mapel')
                ->with('guru')->with('siswa')->orderBy('tanggal', 'desc')->where('tanggal', '=', $req->date)->where('kelas_id', '=',$kls->id )
                ->get();
                $dx =$req->date;

            }else{
                $jurnal = Jurnal::with('mapel')
                ->with('guru')->with('siswa')->orderBy('tanggal', 'desc')->where('tanggal', '=', $dt->toDateString())->where('kelas_id', '=',$kls->id )
                ->get();
                $dx =$dt->toDateString();
            }
        }
        elseif(Auth::user()->role == 2) {
            if ($req->has('date') ) {
                $jurnal = Jurnal::with('mapel')
                ->with('guru')->with('siswa')->orderBy('tanggal', 'desc')->where('tanggal', '=', $req->date)->simplePaginate(10);
                $dx =$req->date;
                $jurnal->appends(['date' => $req->date]);
            }else{
                $jurnal = Jurnal::with('mapel')
                ->with('guru')->with('siswa')->orderBy('tanggal', 'desc')->where('tanggal', '=', $dt->toDateString())->simplePaginate(10);
                $dx =$dt->toDateString();
            }
        }
        elseif(Auth::user()->role == 3){
            if ($req->has('date') ) {
                $jurnal_valid = Jurnal::with('mapel')
                ->with('guru')->with('siswa')->orderBy('tanggal', 'desc')->where('tanggal', '=', $req->date)->where('valid', '=', 1)->where('guru_id', '=', $guru)->simplePaginate(10);
                $jurnal_invalid = Jurnal::with('mapel')
                ->with('guru')->with('siswa')->orderBy('tanggal', 'desc')->where('tanggal', '=', $req->date)->where('valid', '=', 0)->where('guru_id', '=', $guru)->simplePaginate(10);
                $dx =$req->date;
                $jurnal->appends(['date' => $req->date]);
            }else{
                $jurnal_valid = Jurnal::with('mapel')
                ->with('guru')->with('siswa')->orderBy('tanggal', 'desc')->where('tanggal', '=', $dt->toDateString())->where('valid', '=', 1)->where('guru_id', '=', $guru)->simplePaginate(10);
                $jurnal_invalid = Jurnal::with('mapel')
                ->with('guru')->with('siswa')->orderBy('tanggal', 'desc')->where('tanggal', '=', $dt->toDateString())->where('valid', '=', 0)->where('guru_id', '=', $guru)->simplePaginate(10);
                $dx =$dt->toDateString();
            }
        }
        $jam = $this->jamke;
        if (Auth::user()->role == 1) {
            return view('Jurnal.index[ketua]', compact('jurnal','mpl','gr','jam','siswa','dx','cls','today'));
        }
        elseif (Auth::user()->role == 2) {
            return view('Jurnal.index[admin]', compact('jurnal','mpl','gr','jam','siswa','dx','cls','today'));
        }
        elseif (Auth::user()->role == 3) {
            return view('Jurnal.index[guru]', compact('mpl','gr','jam','siswa','dx','cls','today','jurnal_valid','jurnal_invalid'));
        }
    }

    public function createpk(Request $req)
    {
        //Variabel
        $dt =Carbon::now();
        $kelas = Auth::user()->kelas_id;
        $kls = Kelas::find($kelas);

        //Input Tabel Jurnal
        $jurnal = new Jurnal();
        $jurnal->kelas_id = $kls->id;
        $jurnal->tanggal = $dt->toDateString();
        $jurnal->jam = $this->jamke;
        $jurnal->mapel_id = $req->mapel;
        $jurnal->guru_id = $req->guru;
        $jurnal->materi = $req->materi;
        $jurnal->keterangan = $req->keterangan;

        //Validasi
        $valid = Jurnal::where('jam', '=',$this->jamke)->where('tanggal', '=', $dt->toDateString())->where('kelas_id', '=', $kls->id)->first();
        if ($valid == null) {
            $jurnal->save();
            return redirect('/jurnal');
        }
        else{
            return redirect()->back();
        }
    }

    public function createpg(Request $req)
    {
        $dt =Carbon::now();
        $guru = Auth::user()->guru_id;

        $jurnal = new Jurnal();
        $jurnal->kelas_id = $req->kelas;
        $jurnal->tanggal = $dt->toDateString();
        $jurnal->jam = $this->jamke;
        $jurnal->mapel_id = $req->mapel;
        $jurnal->guru_id = $guru;
        $jurnal->materi = $req->materi;
        $jurnal->keterangan = $req->keterangan;
        $jurnal->valid = 0;

        $valid = Jurnal::where('jam', '=', $this->jamke)->where('tanggal', '=', $dt->toDateString())->first();
        if ($valid == null) {
            $jurnal->save();
            return redirect('/jurnal');
        }
        else{
            alert()->error('','Jurnal Sudah Ada')->background('#3B4252')->autoClose(2000);
            return redirect()->back();
        }
    }

    public function add(Jurnal $id)
    {
        $dt =Carbon::now();
        $dt = $dt->toDateString();
        $kelas = $id->kelas_id;
        if($dt == $id->tanggal){
            $siswa = Siswa::where('kelas_id','=',$kelas)->get();
            return view('Jurnal.add',compact('id','siswa'));
        }
        else{
            alert()->error('','Batas Edit Kadaluarsa')->background('#3B4252')->autoClose(2000);
            return redirect()->back();
        }
    }

    public function addp(Request $req, Jurnal $id)
    {
        $jurnal = Jurnal::find($id->id);
        $absen = collect($req->absen);
        $keterangan = collect($req->abs);
        $jumlah = $absen->count();
        if($keterangan->contains('#')){
            alert()->error('','Lengkapi Keterangan Absensi')->background('#3B4252')->autoClose(2000);
            return redirect()->back();
        }
        else{
            $valid = DB::table('jurnal_siswa')->where('jurnal_id', $id->id)->where('siswa_id', $req->absen)->first();
            if ($valid == null) {
                for ($i=0; $i <$jumlah ; $i++) {
                    DB::insert('insert into jurnal_siswa (jurnal_id, siswa_id,keterangan) values (?, ?, ?)', [$id->id,$absen[$i], $keterangan[$i]]);
                }
                alert()->success('','Absen Siswa Berhasil Ditambahkan')->background('#3B4252')->autoClose(2000);
                return redirect('/jurnal');
            }
            else {

                $dx = array_search($valid->siswa_id, $req->absen);
                DB::table('jurnal_siswa')
                ->where('id', $valid->id)
                ->update(['keterangan' => $keterangan[$dx]]);
                return redirect('/jurnal');
            }
        }

    }
    public function edit(Jurnal $id)
    {
        $dt =Carbon::now();
        $dt = $dt->toDateString();
        if($id->valid == 1){
            alert()->error('','Eitss Tidak Bisa')->background('#3B4252')->autoClose(2000);
            return redirect('/jurnal');
        }
        else {
            if ($dt == $id->tanggal) {
                $mpl = Mapel::orderBy('mapel','asc')->get();
                $gr = Guru::all();
                return view('Jurnal.edit',compact('id','mpl','gr'));
            }
            else{
                alert()->error('','Batas Edit Kadaluarsa')->background('#3B4252')->autoClose(2000);
                return redirect()->back();
            }
        }
    }
    public function editp(Request $req,Jurnal $id)
    {
        if($id->valid == 1 ){
            alert()->error('','Eitss Tidak Bisa')->background('#3B4252')->autoClose(2000);
            return redirect('/jurnal');
        }
        else {
            $id->fill($req->all());
            $id->mapel_id = $req->mapel_id;
            $id->guru_id = $req->guru_id;
            $id->save();
            return redirect('/jurnal');
        }
    }

    public function info(Jurnal $id)
    {
        return view('Jurnal.info',compact('id'));
    }

    public function delete(Jurnal $id)
    {
        $dt =Carbon::now();
        $dt = $dt->toDateString();
        if ($id->valid == 1) {
            alert()->error('','Eitss Tidak Bisa')->background('#3B4252')->autoClose(2000);
            return redirect('/jurnal');
        }
        else {
            if ($dt == $id->tanggal) {
                DB::table('jurnal_siswa')->where('jurnal_id','=',$id->id)->delete();
                $id->delete();
                alert()->success('','Jurnal Jam ke - '. $id->jam . ' - ' .$id->tanggal .' Berhasil Dihapus')->background('#3B4252')->autoClose(2000);
                return redirect()->back();
            } else {
                alert()->error('','Batas Hapus Kadaluarsa')->background('#3B4252')->autoClose(2000);
                return redirect()->back();
            }
        }
    }

    public function bulanan(Request $req,Jurnal $jurnal)
    {
        $dt = Carbon::now()->isoFormat('YYYY-MM');
        $month = Carbon::parse($req->search)->format("M");
        $year = Carbon::parse($req->search)->format("Y");
        $kelas = Auth::user()->kelas_id;
        $kls = Kelas::find($kelas);
        if (Auth::user()->role == 2) {
            if ($req->has('search')) {
                $jurnal = Jurnal::with('mapel')
                            ->with('guru')->with('siswa')->with('kelas')->orderBy('tanggal', 'desc')->where('tanggal', 'LIKE', '%' . $req->search . '%')
                            ->paginate(15);
                $dt = $req->search;
            }
            else{
                $jurnal = Jurnal::with('mapel')
                            ->with('guru')->with('siswa')->with('kelas')->orderBy('tanggal', 'desc')
                            ->paginate(15);
            }
        }
        else {
            if ($req->has('search')) {
                $jurnal = Jurnal::with('mapel')
                            ->with('guru')->with('siswa')->with('kelas')->orderBy('tanggal', 'desc')->where('tanggal', 'LIKE', '%' . $req->search . '%')->where('kelas_id', '=', $kls->id)
                            ->paginate(15);
                $dt = $req->search;
            }
            else{
                $jurnal = Jurnal::with('mapel')
                            ->with('guru')->with('siswa')->with('kelas')->orderBy('tanggal', 'desc')->where('kelas_id', '=', $kls->id)
                            ->paginate(15);
            }
        }

        return view('Jurnal.bulanan',compact('jurnal','dt','month','year'));
    }

    public function print(Request $req)
    {
        dd($req->kelas);
        if($req->kelas == 00){
            $jurnal = Jurnal::with('mapel')
            ->with('guru')->with('siswa')->with('kelas')->orderBy('tanggal', 'desc')->where('tanggal', 'LIKE', '%' . $req->bulan . '%')
            ->get();
            $kelas = "All";
        }else{
            $jurnal = Jurnal::with('mapel')
            ->with('guru')->with('siswa')->with('kelas')->orderBy('tanggal', 'desc')->where('tanggal', 'LIKE', '%' . $req->bulan . '%')->where('kelas_id','=',$req->kelas)
            ->get();
            $kelas = Kelas::find($req->kelas);
            $kelas = $kelas->kelas;
        }
        $month = Carbon::parse($req->bulan)->format("M");
        $year = Carbon::parse($req->bulan)->format("Y");
        $pdf = PDF::loadview('Jurnal.jurnal_pdf',compact('jurnal','month','year'));
        $pdf->setPaper('A4','landscape');

        return $pdf->stream('Jurnal_'. $req->bulan .'_'. $kelas);
    }

    public function kelas(Kelas $id, Request $req)
    {
        $dt =Carbon::now();
        $mpl = Mapel::orderBy('mapel','asc')->get();
        $gr = Guru::all();
        $kelas = Auth::user()->kelas_id;
        $siswa = Siswa::where('kelas_id','=',$kelas)->get();
        $kls = Kelas::find($kelas);
        $cls = Kelas::all();

        if ($req->has('date') ) {
            $jurnal = Jurnal::with('mapel')
            ->with('guru')->with('siswa')->orderBy('tanggal', 'desc')->where('tanggal', '=', $req->date)->where('kelas_id', '=',$id->id )
            ->simplePaginate(10);
            $jurnal->appends(['date' => $req->date]);
            $dx =$req->date;

        }else{
            $jurnal = Jurnal::with('mapel')
            ->with('guru')->with('siswa')->orderBy('tanggal', 'desc')->where('tanggal', '=', $dt->toDateString())->where('kelas_id', '=',$id->id )
            ->simplePaginate(10);
            $dx =$dt->toDateString();
        }
        $jam = $this->jamke;
        return view('Jurnal.index', compact('jurnal','mpl','gr','jam','siswa','dx','cls','id'));
    }
    public function acc(Jurnal $id)
    {
        $id->valid = 1;
        $id->save();
        alert()->success('','Jurnal Berhasil Di Accept')->background('#3B4252')->autoClose(2000);
        return redirect()->back();
    }
}

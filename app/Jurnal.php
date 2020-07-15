<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Mapel;

class Jurnal extends Model
{
    protected $table = 'jurnal';
    protected $fillable = ['kelas','jam','tanggal','id_mapel','id_guru','materi','keterangan','absensi'];

    public function mapel()
    {
        return $this->belongsTo(Mapel::class);
    }
    function guru()
    {
        return $this->belongsTo(Guru::class);
    }
    function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
    function siswa(){
        return $this->belongsToMany(Siswa::class)->withPivot(['keterangan'])->orderBy('keterangan','desc');
    }
}

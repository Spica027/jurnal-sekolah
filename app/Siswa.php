<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';
    protected $fillable = ['nama','kelas_id'];
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
    public function roles()
    {
        return $this->belongsToMany(Jurnal::class)->withPivot(['keterangan']);
    }
}

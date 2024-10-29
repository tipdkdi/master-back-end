<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MahasiswaPrestasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'mahasiswa_id',
        'jenis_prestasi',
        'tingkat_prestasi',
        'nama_prestasi',
        'tahun_prestasi',
        'penyelenggara',
    ];
    public function mahasiswa()
    {
        return $this->belongsTo('App\Models\Mahasiswa');
    }
}

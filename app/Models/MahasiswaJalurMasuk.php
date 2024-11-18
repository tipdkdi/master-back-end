<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MahasiswaJalurMasuk extends Model
{
    use HasFactory;

    protected $fillable = [
        'mahasiswa_id',
        'tahun_akademik_id',
        'jalur_pendaftaran',
        'jenis_pendaftaran',
        'tanggal_masuk',
        'pembiayaan_awal',
        'biaya_masuk',
    ];

    public function tahunAkademik()
    {
        return $this->belongsTo('App\Models\TahunAkademik');
    }
    public function mahasiswa()
    {
        return $this->belongsTo('App\Models\Mahasiswa');
    }
}

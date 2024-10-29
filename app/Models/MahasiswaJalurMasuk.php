<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MahasiswaJalurMasuk extends Model
{
    use HasFactory;

    protected $fillable = [
        'mahasiswa_id',
        'jalur_pendaftaran',
        'jenis_pendaftaran',
        'tanggal_masuk',
        'periode_pendaftaran',
        'pembiayaan_awal',
        'biaya_masuk',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo('App\Models\Mahasiswa');
    }
}

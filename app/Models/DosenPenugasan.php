<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DosenPenugasan extends Model
{
    use HasFactory;

    protected $fillable = [
        'dosen_id',
        'tahun_ajar',
        'prodi', //ini homebase
        'surat_tugas_nomor',
        'surat_tugas_tanggal',
        'surat_tugas_tmt',
        'surat_tugas_file', //nullable
        'is_active',
    ];

    public function dosen()
    {
        return $this->belongsTo('App\Models\Dosen');
    }
    public function homebase()
    {
        return $this->belongsTo('App\Models\Organisasi', 'prodi');
    }
}

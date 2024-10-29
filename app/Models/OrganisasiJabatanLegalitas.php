<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganisasiJabatanLegalitas extends Model
{
    use HasFactory;
    protected $fillable = [
        'organisasi_id',
        'tahun',
        'tanggal_mulai',
        'tanggal_selesai',
        'sk_nomor',
        'sk_tanggal',
    ];

    public function organisasi()
    {
        return $this->hasMany('App\Models\Organisasi');
    }
}

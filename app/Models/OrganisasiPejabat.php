<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganisasiPejabat extends Model
{
    use HasFactory;

    protected $fillable = [
        'organisasi_id',
        'jabatan_id',
        'pegawai_id',
        'jabatan',
        'is_aktif',
    ];

    public function organisasi()
    {
        return $this->belongsTo('App\Models\Organisasi');
    }
    public function pegawai()
    {
        return $this->belongsTo('App\Models\Pegawai');
    }
    public function jabatan()
    {
        return $this->belongsTo('App\Models\OrganisasiGrupJabatan', 'jabatan_id');
    }
}

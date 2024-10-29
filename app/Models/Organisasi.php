<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organisasi extends Model
{
    use HasFactory;
    protected $fillable = [
        'organisasi_grup_id',
        'parent_id',
        'organisasi_nama',
        'pddikti_kode',
        'singkatan',
        'singkatan_sia',
        'keterangan',
        'urutan',
        'is_current',
        'is_aktif',
    ];

    public function grup()
    {
        return $this->belongsTo('App\Models\OrganisasiGrup', 'organisasi_grup_id');
    }
    public function child()
    {
        return $this->hasMany('App\Models\Organisasi', 'parent_id');
    }

    public function parentOrganisasi()
    {
        return $this->belongsTo('App\Models\Organisasi', 'parent_id');
    }
    public function fakultas()
    {
        return $this->belongsTo('App\Models\Organisasi', 'parent_id');
    }

    public function pejabat()
    {
        return $this->hasMany('App\Models\OrganisasiPejabat');
    }

    public function mahasiswa()
    {
        return $this->hasMany('App\Models\Mahasiswa');
    }
}

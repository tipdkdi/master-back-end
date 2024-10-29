<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganisasiGrupJabatan extends Model
{

    //INI UNTUK JABATAN DI ORGANISASI GRUP, MISALNYA DI GRUP FAKULTAS JABATAN YANG ADA DEKAN, WADEK, DLL
    //MISALNYA JUGA UNTUK GRUP PRODI, ADA KAPRODI, SEKRETARIS PRODI DLL
    //UNTUK MASTER JABATAN DI ORGANISASI GRUP
    use HasFactory;
    protected $fillable = [
        'organisasi_grup_id',
        'jabatan',
        'flag',
        'urutan',
        'keterangan',
        'is_aktif',
    ];

    public function organisasiGrup()
    {
        return $this->belongsTo('App\Models\OrganisasiGrup');
    }
    public function pejabat()
    {
        return $this->hasMany('App\Models\OrganisasiPejabat');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PegawaiJabatan extends Model
{
    use HasFactory;

    //ini untuk jabatan fungsional. misalnya asisten_ahli, prakom, prahum, asriparis dll
    protected $fillable = [
        'pegawai_id',
        'master_jabatan_id',
        'jabatan',
        'pangkat',
        'golongan',
        'is_current',
    ];
    public function pegawai()
    {
        return $this->belongsTo('App\Models\Pegawai');
    }
    public function masterJabatan()
    {
        return $this->belongsTo('App\Models\MasterJabatan');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PegawaiStatusAsn extends Model
{
    use HasFactory;
    protected $fillable = [
        'asn_nama',
        'singkatan',
        'sebutan_nomor_induk',
        'is_asn',
    ];

    public function pegawai()
    {
        return $this->hasMany('App\Models\Pegawai');
    }
}

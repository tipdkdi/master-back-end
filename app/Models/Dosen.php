<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;
    protected $fillable = [
        'pegawai_id',
        'nomor_dosen',
        'dosen_kategori',
        'homebase',
    ];

    public function pegawai()
    {
        return $this->belongsTo('App\Models\Pegawai');
    }
    public function penugasan()
    {
        return $this->hasMany('App\Models\DosenPenugasan');
    }
}

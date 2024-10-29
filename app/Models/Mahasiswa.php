<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'iddata',
        'nisn',
        'nim',
        'biodata_id',
        'prodi_id',
        'is_luar_negeri',
    ];

    public function biodata()
    {
        return $this->belongsTo('App\Models\Biodata');
    }
    public function prodi()
    {
        return $this->belongsTo('App\Models\Organisasi', 'prodi_id');
    }
    public function orangTua()
    {
        return $this->hasOne('App\Models\MahasiswaOrangTua');
    }
}

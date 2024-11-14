<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterJabatan extends Model
{
    use HasFactory;
    protected $fillable = [
        'jabatan',
        'is_dosen',
        'keterangan'
    ];
    public function pegawaiJabatan()
    {
        return $this->hasMany('App\Models\PegawaiJabatan');
    }
}

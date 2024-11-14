<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biodata extends Model
{
    use HasFactory;
    // protected $table = 'biodatas';
    protected $fillable = [
        'nik',
        'nama_lengkap',
        'jenis_kelamin',
        'lahir_tempat',
        'lahir_tanggal',
        'no_hp',
        'agama',
        'alamat_domisili',
    ];

    public function user()
    {
        return $this->hasOne('App\Models\User');
    }
    public function mahasiswa()
    {
        return $this->hasOne('App\Models\Mahasiswa');
    }
    public function pegawai()
    {
        return $this->hasOne('App\Models\Pegawai');
    }
}

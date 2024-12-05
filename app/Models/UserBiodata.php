<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBiodata extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'biodata_id',
        'jenis',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function biodata()
    {
        return $this->belongsTo('App\Models\Biodata');
    }
    // public function biodata()
    // {
    //     if ($this->jenis == 'pegawai') {
    //         return $this->belongsTo('App\Models\Pegawai', 'biodata_id');
    //     } elseif ($this->jenis == 'mahasiswa') {
    //         return $this->belongsTo('App\Models\Mahasiswa', 'biodata_id');
    //     }

    //     // Jika ada jenis lain, tambahkan kondisi lain di sini
    // }
}

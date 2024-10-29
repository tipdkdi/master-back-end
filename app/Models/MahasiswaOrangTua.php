<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MahasiswaOrangTua extends Model
{
    use HasFactory;
    // protected $table = 'mahasiswa_orang_tuas';

    protected $fillable = [
        'mahasiswa_id',
        'ayah_nik',
        'ayah_nama',
        'ayah_tgl_lahir',
        'pekerjaan_ayah_id',
        'pendapatan_ayah_id',
        'ibu_nik',
        'ibu_nama',
        'ibu_tgl_lahir',
        'pekerjaan_ibu_id',
        'pendapatan_ibu_id',
        'hp_ortu',
        'alamat',
        'kelurahan',
        'kecamatan_id',
        'kecamatan',
        'kabupaten',
        'provinsi',
    ];


    public function mahasiswa()
    {
        return $this->belongsTo('App\Models\Mahasiswa');
    }
    public function pekerjaanAyah()
    {
        return $this->belongsTo('App\Models\MasterPekerjaan', 'pekerjaan_ayah_id');
    }
    public function pekerjaanIbu()
    {
        return $this->belongsTo('App\Models\MasterPekerjaan', 'pekerjaan_ibu_id');
    }
    public function pendapatanAyah()
    {
        return $this->belongsTo('App\Models\MasterPendapatan', 'pendapatan_ayah_id');
    }
    public function pendapatanIbu()
    {
        return $this->belongsTo('App\Models\MasterPendapatan', 'pendapatan_ibu_id');
    }
}

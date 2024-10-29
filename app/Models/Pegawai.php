<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;
    protected $fillable = [
        'idpeg',
        'pegawai_nomor_induk',
        'biodata_id',
        'status_asn_id',
        'kategori_id',
        'is_dosen',
    ];

    public function dosen()
    {
        return $this->hasOne('App\Models\Dosen');
    }
    public function pejabat()
    {
        return $this->hasMany('App\Models\OrganisasiPejabat');
    }
    public function biodata()
    {
        return $this->belongsTo('App\Models\Biodata');
    }
    public function statusAsn()
    {
        return $this->belongsTo('App\Models\PegawaiStatusAsn');
    }
    public function kategori()
    {
        return $this->belongsTo('App\Models\PegawaiKategori');
    }
}

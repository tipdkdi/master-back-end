<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerguruanTinggi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'singkatan',
        'alamat_1',
        'alamat_2',
        'alamat_3',
        'alamat_4',
        'kode_pddikti',
        'kode_kemenag',
        'is_current',
    ];
}

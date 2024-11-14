<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'role_id',
        'is_default', //jika true akan jadi role yang dituju ketika login sukses
        'is_active', //jika tidak aktif tampilkan keterangan "sudah tidak bisa akses role"
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }
}

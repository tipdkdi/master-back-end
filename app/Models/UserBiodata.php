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
        'is_aktif',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function biodata()
    {
        return $this->belongsTo('App\Models\Biodata');
    }
}

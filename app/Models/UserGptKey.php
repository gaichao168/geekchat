<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGptKey extends Model
{
    use HasFactory;

    protected $fillable = [
        'key','start_at','end_at'
        ];
}

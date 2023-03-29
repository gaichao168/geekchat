<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpenAiKey extends Model
{
    use HasFactory;


    protected $fillable = ['end_at'];
}

<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Resume extends Model
{
    protected $fillable = [
        'id_user',
        'title',
    ];
}

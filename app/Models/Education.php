<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $fillable = [
        'school_name',
        'degree',
        'edu_start',
        'edu_end',
        'edu_desc',];
}

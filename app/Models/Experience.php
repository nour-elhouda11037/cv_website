<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = [
        'resume_id',
        'company_name',
        'position',
        'exp_start',
        'exp_end',
        'exp_desc',];
}

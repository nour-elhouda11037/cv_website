<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Resume extends Model{
    protected $fillable = [
        'id_user',
        'title',
    ];
    public function user(){
    return $this->belongsTo(User::class, 'id_user');}
    public function education(): HasMany{
        return $this->hasMany(Education::class, 'id_resume');}
    public function experience(): HasMany{
        return $this->hasMany(Experience::class, 'id_resume');}
    public function skills(): HasMany{
        return $this->hasMany(Skill::class, 'id_resume');}
}


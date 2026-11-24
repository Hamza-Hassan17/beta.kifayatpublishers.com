<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Teacher extends Authenticatable
{
    use HasFactory;

    protected $table = 'teacher';

    protected $fillable = [
        'name',
        'phone',
        'email',
        'password',
        'profile_img',
        'school_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function school(){
        return $this->belongsTo(School::class, 'school_id', 'id');
    }
}

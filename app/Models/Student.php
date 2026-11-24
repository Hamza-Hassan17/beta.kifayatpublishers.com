<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    use HasFactory;

    protected $table = 'student';

    protected $fillable = [
        'name',
        'roll_number',
        'phone',
        'email',
        'password',
        'profile_img',
        'grade_id',
        'school_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function school(){
        return $this->belongsTo(School::class);
    }

    public function grade(){
        return $this->belongsTo(Grade::class);
    }
}

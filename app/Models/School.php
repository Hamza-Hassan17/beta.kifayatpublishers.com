<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'location'
    ];

    public function student()
    {
        return $this->hasMany(Student::class, 'school_id');
    }

    public function teacher(){
        return $this->hasMany(Teacher::class, 'school_id');
    }
}

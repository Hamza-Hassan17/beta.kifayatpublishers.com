<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $table = 'grade';

    protected $fillable = [
        'name'
    ];

    public function student(){
        return $this->hasMany(Student::class,  'class_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessCode extends Model
{
    use HasFactory;

    protected $table = 'accesscode';

    protected $fillable = [
        'code'
    ];

    public function books()
    {
        return $this->belongsToMany(Book::class, 'bookaccesscode', 'code_id', 'book_id');
    }
}

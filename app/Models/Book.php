<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'chapters',
        'author'
    ];

    // public function book()  
    // {  
    //     return $this->belongsTo(Permission::class,'book_id');  
    // }  
}

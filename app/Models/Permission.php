<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'editor_id',
        'book_id'
    ];


    public function book()  
    {  
        return $this->belongsTo(Book::class,'book_id');  
    }  
}



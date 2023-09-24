<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'parent_id',
        'book_id'
    ];

    public function child(){
            return $this->hasMany(Section::class,'parent_id');
    }

    public function parent(){
        return $this->hasOne(Section::class,'parent_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    use HasFactory;
    
    //* protected $guarded = [];

    protected $fillable = [
        'content',
        'like',
    ];

    //* Relationship between Idea and Comment
    public function comments(){
        return $this->hasMany(Comment::class);
    }

}

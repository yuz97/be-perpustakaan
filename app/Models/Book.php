<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function photoUrl(){
        return asset('storage/'.$this->image_url);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
}

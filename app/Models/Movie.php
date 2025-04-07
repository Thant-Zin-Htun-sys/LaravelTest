<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'genre_id', 'released_date'
    ];

    public function rating(){
        return $this->hasMany(Rating::class,'movie_id');
    }

    public function genre() {
        return $this->belongsTo(Genre::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'poster', 'director_id', 'year'];

    public function director() { 
        return $this->belongsTo(Director::class);
    }
    public function actors() {
        return $this->belongsToMany(Actor::class);
    } public function genres() {
        return $this->belongsToMany(Genre::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'film_id',
        'user_id',
        'rating',
        'comment',
    ];

    /**
     * Get the film that the review belongs to.
     */
    public function film()
    {
        return $this->belongsTo(Film::class);
    }

    /**
     * Get the user that the review belongs to.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

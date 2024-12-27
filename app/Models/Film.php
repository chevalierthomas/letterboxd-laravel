<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    // Définit les champs qui peuvent être remplis par des assignations de masse
    protected $fillable = [
        'title',
        'year',
        'synopsis',
        'director_id',
        'image', // Nouveau champ
    ];

    // Relation avec Director
    public function director()
    {
        return $this->belongsTo(Director::class);
    }

    // Relation avec Genre
    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function watchedBy()
    {
        return $this->belongsToMany(User::class, 'watched_films')->withTimestamps();
    }

}

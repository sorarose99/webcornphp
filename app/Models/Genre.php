<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'movie_genres');
    }
    public function tvShows()
    {
        return $this->belongsToMany(TVShowDetails::class, 'tv_show_genres', 'genre_id', 'tmdb_id');
    }
}
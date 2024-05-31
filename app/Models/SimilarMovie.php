<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SimilarMovie extends Model
{
    use HasFactory;

    protected $table = 'similar_movies';

   
    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'similar_movies', 'similar_movie_id', 'tmdb_id');
    }

    // Define the inverse relationship
    public function movieDetails()
    {
        return $this->belongsTo(MovieDetails::class, 'similar_movies', 'tmdb_id', 'similar_movie_id');
    }
}



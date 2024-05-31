<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $primaryKey = 'tmdb_id';
    protected $table = 'movie_details';
    protected $fillable = [
        'tmdb_id',
        'title',
        'poster_url',
        'backdrop_url',
        'vote_average',
        'release_date',
        'overview',
        'is_movie',
    ];
    public function similarMovies()
{
    return $this->belongsToMany(SimilarMovie::class, 'similar_movies', 'tmdb_id', 'similar_movie_id');
}

    public function details()
    {
        return $this->hasOne(MovieDetails::class, 'tmdb_id');
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'movie_genres', 'movie_tmdb_id', 'genre_id');
    }

    public function cast()
    {
        return $this->hasMany(Cast::class, 'movie_tmdb_id', 'tmdb_id');
    }
    public function scopeSearch($query, $term)
    {
        return $query->where('title', 'LIKE', '%' . $term . '%')
                     ->orWhere('overview', 'LIKE', '%' . $term . '%');
    }
}

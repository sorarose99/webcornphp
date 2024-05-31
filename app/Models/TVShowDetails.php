<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TVShowDetails extends Model
{
    use HasFactory;
    protected $table = 'tv_shows';
    protected $primaryKey = 'tmdb_id';

    protected $fillable = [
        'tmdb_id',
        'title',
        'poster_url',
        'backdrop_url',
        'release_date',
        'last_episode_to_air_id',
        'genres',
        'overview',
        'vote_average',
        'vote_count',
        'trailer_url',
        'number_of_seasons',
    ];

    public function tvShow()
    {
        return $this->belongsTo(TvShows::class, 'tmdb_id', 'tmdb_id');
    }

    public function seasons()
    {
        return $this->hasMany(Season::class, 'tmdb_id', 'tmdb_id');
    }

    public function episodes()
    {
        return $this->hasMany(Episode::class, 'tmdb_id', 'tmdb_id');
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'tv_show_genres', 'tmdb_id', 'genre_id');
    }
    public function cast()
    {
        return $this->hasMany(Cast::class, 'tmdb_id', 'tmdb_id');
    }
   
    public function reviews()
    {
        return $this->hasMany(Review::class, 'tmdb_id', 'tmdb_id');
    }
    
    public function similarShows()
    {
        return $this->belongsToMany(
            TVShowDetails::class,
            'similar_shows',
            'tmdb_id',
            'similar_tmdb_id'
        );
    }
}

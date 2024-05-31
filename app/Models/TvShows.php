<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TvShows extends Model
{
    use HasFactory;
    protected $table = 'tv_shows';
    protected $primaryKey = 'tmdb_id';

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

  
    public function tvShowDetails()
    {
        return $this->hasOne(TVShowDetails::class, 'tmdb_id', 'tmdb_id');
    }
    public function scopeSearch($query, $term)
    {
        return $query->where('title', 'LIKE', '%' . $term . '%')
                     ->orWhere('overview', 'LIKE', '%' . $term . '%');
    }

}

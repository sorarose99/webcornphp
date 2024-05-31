<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $primaryKey = 'tmdb_id';
    protected $table = 'reviews';


    protected $fillable = [
        'tmdb_id',

        'author_name',
        'author_username',
        'avatar_url',
        'rating',
        'content',
        'elapsed_time',
    ];

  
    public function movieDetails()
    {
        return $this->belongsTo(MovieDetails::class, 'tmdb_id', 'tmdb_id');
    }
    public function tvShow()
    {
        return $this->belongsTo(TVShowDetails::class, 'tmdb_id', 'tmdb_id');
    }
    public function TVShowDetails()
    {
        return $this->belongsTo(TVShowDetails::class, 'tmdb_id', 'tmdb_id');
    }
}

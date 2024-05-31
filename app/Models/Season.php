<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;
    protected $table = 'seasons';

    protected $fillable = [
        'tmdb_id',
        'season_number',
        'air_date',
        'episode_count',
        'poster_url',
        'overview',
    ];

    public function tvShow()
    {
        return $this->belongsTo(TVShowDetails::class, 'tmdb_id', 'tmdb_id');
    }

    public function episodes()
    {
        return $this->hasMany(Episode::class, 'seasons_id', 'id');
    }
}

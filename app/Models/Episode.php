<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'season_number',
        'episode_number',
        'name',
        'runtime',
        'still_path',
        'air_date',
        'overview',
        'tmdb_id',
        'season_id',
    ];

    public function tvShow()
    {
        return $this->belongsTo(TVShowDetails::class, 'tmdb_id', 'tmdb_id');
    }

    public function season()
    {
        return $this->belongsTo(Season::class, 'seasons_id', 'id');
    }
}
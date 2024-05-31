<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TVShowDetails;
use App\Models\movieDetails;

class Cast extends Model
{
    use HasFactory;
    protected $primaryKey = 'tmdb_id';
    protected $table = 'cast';
    protected $fillable = [
        'tmdb_id',
        'actor_name',
        'character_name',
        'profile_path',
        'cast_id',
        'gender',
        'known_for_department',
        'popularity',
        'order',
    ];

    public function movieDetails()
    {
        return $this->belongsTo(MovieDetails::class, 'tmdb_id', 'tmdb_id');
    }

    public function TVShowDetails()
    {
        return $this->belongsTo(TVShowDetails::class, 'tmdb_id', 'tmdb_id');
    }
}
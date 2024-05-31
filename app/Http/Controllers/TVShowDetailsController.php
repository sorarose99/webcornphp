<?php
namespace App\Http\Controllers;

use App\Models\TVShowDetails;
use Illuminate\Http\Request;
use App\Models\TvShows;
use App\Models\Season;
use App\Models\Genre;

class TVShowDetailsController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tmdb_id' => 'required|integer',
            'title' => 'required|string',
            'poster_url' => 'nullable|string',
            'backdrop_url' => 'nullable|string',
            'release_date' => 'nullable|date',
            'last_episode_to_air_id' => 'nullable|integer',
            'overview' => 'nullable|string',
            'vote_average' => 'nullable|numeric',
            'vote_count' => 'nullable|integer',
            'trailer_url' => 'nullable|string',
            'number_of_seasons' => 'nullable|integer',
            'genres' => 'array',
            'genres.*' => 'integer|exists:genres,id',
        ]);

        $tvShowDetails = TVShowDetails::create($validatedData);
        if (isset($validatedData['genres'])) {
            $tvShowDetails->genres()->sync($validatedData['genres']);
        }

        return response()->json($tvShowDetails, 201);
    }

    public function getSeasonDetailsPath(int $tmdb_id, int $season_number)
    {
        $tvShow = TvShows::findOrFail($tmdb_id);
        $season = Season::where('tmdb_id', $tmdb_id)
                        ->where('season_number', $season_number)
                        ->with('episodes')
                        ->firstOrFail();

        return response()->json([
            'tv_show' => $tvShow,
            'season' => $season,
            'episodes' => $season->episodes,
        ]);
    }
    public function getAllPopularTvShowsPath(int $page=1000)
    {
        $tvShowDetails = TVShowDetails::orderByDesc('popularity')->paginate($page);

        return response()->json(['results' => $tvShowDetails->items(), 'total_pages' => $tvShowDetails->lastPage()]);
    }

    public function getPopularTV(int $limit = 10)
    {
        $tvShow = TvShows::orderByDesc('popularity')->paginate($limit);

        return response()->json(['results' => $tvShow->items(), 'total_pages' => $tvShow->lastPage()]);
    }

    public function getTopRatedTV(int $limit = 10)
    {
        $tvShow = TvShows::orderByDesc('vote_average')->paginate($limit);

        return response()->json(['results' => $tvShow->items(), 'total_pages' => $tvShow->lastPage()]);
    }

    public function getAllTopRatedTVPath(int $page=1000)
    {
        $tvShow = TvShows::orderByDesc('vote_average')->paginate($page);

        return response()->json(['results' => $tvShow->items(), 'total_pages' => $tvShow->lastPage()]);
    }

    public function getTV(int $tmdb_id)
    {
        $tvShowDetails = TVShowDetails::with(['episodes', 'seasons', 'genres', 'similarShows', 'cast', 'reviews'])->findOrFail($tmdb_id);
        return response()->json($tvShowDetails);
    }







    public function getUpcomingTV(int $limit = 10)
    {
        $tvShow = TVShowDetails::where('release_date', '>', now())->orderBy('release_date')->paginate($limit);

        return response()->json(['results' => $tvShow->items(), 'total_pages' => $tvShow->lastPage()]);
    }

    public function getTrendingTV(int $limit = 10)
    {
        $tvShow = TvShows::orderByDesc('popularity')->paginate($limit);

        return response()->json(['results' => $tvShow->items(), 'total_pages' => $tvShow->lastPage()]);
    }
}

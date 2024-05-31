<?php

namespace App\Http\Controllers;

use App\Models\TvShows;
use Illuminate\Http\Request;

class TvShowsController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tmdb_id' => 'required|integer',
            'title' => 'required|string',
            'poster_url' => 'required|string',
            'backdrop_url' => 'required|string',
            'vote_average' => 'required|numeric',
            'release_date' => 'required|date',
            'overview' => 'required|string',
            'is_movie' => 'required|boolean',
        ]);

        $tvShow = TvShows::create($validatedData);

        return response()->json($tvShow, 201);
    }

    
    public function on_the_air(int $limit = 10)
    {
        // Fetch now playing movie from the local database
        $tv_Shows = TvShows::where('last_air_date', '<=', now())
                    ->orderBy('last_air_date', 'desc')
                    ->paginate($limit);
    
        return response()->json(['results' => $tv_Shows->items(), 'total_pages' => $tv_Shows->lastPage()]);
    }
    

    public function getPopularTV(int $limit = 10)
    {
        // Fetch popular movie from the local database
        $tvShow = TvShows::orderByDesc('popularity')
            ->paginate($limit);

        return response()->json(['results' => $tvShow->items(), 'total_pages' => $tvShow->lastPage()]);
    }

    public function getTopRatedTV(int $limit = 10)
    {
        // Fetch top-rated movie from the local database
        $tvShow = TvShows::orderByDesc('vote_average')
            ->paginate($limit);

        return response()->json(['results' => $tvShow->items(), 'total_pages' => $tvShow->lastPage()]);
    }
    public function getAllTopRatedTVPath($page=10)
    {
        // Assuming you have a method or query to get top-rated movie
        $tvShow = TvShows::orderByDesc('vote_average')
        ->paginate($page);

        return response()->json(['results' => $tvShow->items(), 'total_pages' => $tvShow->lastPage()]);
    }
    
    public function getTV(int $tmdb_id)
    {
        // Fetch movie details from the local database
        $tvShow = TvShows::findOrFail($tmdb_id);

        return response()->json($tvShow);
    }

    public function getUpcomingTV(int $limit = 10)
    {
        // Fetch upcoming movie from the local database
        $tvShow = TvShows::where('release_date', '>', now())
            ->orderBy('release_date')
            ->paginate($limit);

        return response()->json(['results' => $tvShow->items(), 'total_pages' => $tvShow->lastPage()]);
    }

    public function getTrendingTV(int $limit = 10)
    {
        // Fetch trending movie from the local database
        $tvShow = TvShows::orderByDesc('popularity')
            ->paginate($limit);

        return response()->json(['results' => $tvShow->items(), 'total_pages' => $tvShow->lastPage()]);
    }}

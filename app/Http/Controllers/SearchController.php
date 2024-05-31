<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\TvShows;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Validate the query
        if (!$query) {
            return response()->json(['error' => 'Query parameter is required'], 400);
        }

        // Determine if the query is numeric
        $isNumericQuery = is_numeric($query);

        // Search in movies
        $moviesQuery = Movie::query();
        if ($isNumericQuery) {
            $moviesQuery->where('tmdb_id', $query);
        } else {
            $moviesQuery->where('title', 'LIKE', "%$query%");
        }

        $movies = $moviesQuery->get()->map(function ($movie) {
            return [
                'id' => (int) $movie->tmdb_id, // Ensure 'id' key is an integer
                'poster_path' => $movie->imdb_picture_url,
                'title' => $movie->title,
                'media_type' => 'movie',
            ];
        });

        // Search in TV shows
        $tvShowsQuery = TvShows::query();
        if ($isNumericQuery) {
            $tvShowsQuery->where('tmdb_id', $query);
        } else {
            $tvShowsQuery->where('name', 'LIKE', "%$query%");
        }

        $tvShows = $tvShowsQuery->get()->map(function ($tvShow) {
            return [
                'id' => (int) $tvShow->tmdb_id, // Ensure 'id' key is an integer
                'poster_path' => $tvShow->imdb_picture_url,
                'name' => $tvShow->name,
                'media_type' => 'tv',
            ];
        });

        // Combine the results
        $results = $movies->concat($tvShows)->values();

        return response()->json($results);
    }
}

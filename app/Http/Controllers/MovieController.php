<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models;
use App\Models\MovieDetails;
use Illuminate\Support\Facades\DB;

class MovieController extends Controller
{
  
    public function nowPlaying(int $limit = 10)
    {
        // Fetch now playing movies from the local database
        $movie_details = MovieDetails::where('release_date', '<=', now())
            ->orderBy('release_date', 'desc')
            ->paginate($limit);

        return response()->json(['results' => $movie_details->items(), 'total_pages' => $movie_details->lastPage()]);
    }

    public function getPopularMovie(int $limit = 10)
    {
        // Fetch popular movies from the local database
        $movies = MovieDetails::orderByDesc('popularity')
            ->paginate($limit);

        return response()->json(['results' => $movies->items(), 'total_pages' => $movies->lastPage()]);
    }

    public function getTopRatedMovie(int $limit = 10)
    {
        // Fetch top-rated movies from the local database
        $movies = MovieDetails::orderByDesc('vote_average')
            ->paginate($limit);

        return response()->json(['results' => $movies->items(), 'total_pages' => $movies->lastPage()]);
    }

    public function getAllTopRatedmoviePath($page)
    {
        // Assuming you have a method or query to get top-rated movie
        $movie = MovieDetails::orderByDesc('vote_average')
        ->paginate($page);

        return response()->json(['results' => $movie->items(), 'total_pages' => $movie->lastPage()]);
    }
    
    public function getMovie(int $tmdb_id)
    {
        // Find the movie by its TMDB ID
        $movie = Movie::find($tmdb_id);
    
        // Check if the movie exists
        if (!$movie) {
            // Return a response indicating that the movie was not found
            return response()->json(['error' => 'Movie not found'], 404);
        }
    
        // If the movie exists, retrieve its details
        $details = $movie->details;
    
        // Return the movie details as a JSON response
        return response()->json($details);
    }

    public function getUpcomingmovie(int $limit = 10)
    {
        // Fetch upcoming movie from the local database
        $movie = Movie::where('release_date', '>', now())
            ->orderBy('release_date')
            ->paginate($limit);

        return response()->json(['results' => $movie->items(), 'total_pages' => $movie->lastPage()]);
    }

    public function getTrendingmovie(int $limit = 10)
    {
        // Fetch trending movie from the local database
        $movie = Movie::orderByDesc('popularity')
            ->paginate($limit);

        return response()->json(['results' => $movie->items(), 'total_pages' => $movie->lastPage()]);
    }


    public function getMovieGenres(int $tmdb_id)
    {
        // Fetch movie details from the local database
        $movie = MovieDetails::findOrFail($tmdb_id);

        // Retrieve genres related to the movie
        $genres = $movie->genres;

        return response()->json($genres);
    }
    public function getMovieCollection(int $tmdb_id)
    {
        // Fetch movie details from the local database
        $movie = Movie::findOrFail($tmdb_id);

        // Retrieve the collection related to the movie
        $collection = $movie->collection;

        return response()->json($collection);
    }


    public function getMovieCast(int $tmdb_id)
    {
        // Fetch movie details from the local database
        $movie = Movie::findOrFail($tmdb_id);

        // Retrieve cast related to the movie
        $cast = $movie->cast;

        return response()->json($cast);
    }

    public function fillFromLocal(Request $request, int $tmdb_id)
    {
        // Fetch movie details from the local database
        $movie = Movie::findOrFail($tmdb_id);

        // Update the movie details
        $updated = $movie->fillFromLocal($request->all());

        return response()->json(['success' => $updated]);
    }

    public function updateFromLocal(Request $request, int $tmdb_id)
    {
        // Fetch movie details from the local database
        $movie = Movie::findOrFail($tmdb_id);

        // Update the movie details
        $updated = $movie->updateFromLocal($request->input('locale'), $request->input('with', []));

        return response()->json(['success' => $updated]);
    }
    public function getMovieWatchProviders(int $tmdb_id, ?string $region = null)
    {
        // Fetch movie details from the local database
        $movie = Movie::findOrFail($tmdb_id);

        // Retrieve watch providers related to the movie
        $watchProviders = $movie->watchProviders($region);

        return response()->json($watchProviders);
    }

    public function getMovieRecommendations(int $tmdb_id, ?int $limit = null)
    {
        // Fetch movie details from the local database
        $movie = Movie::findOrFail($tmdb_id);

        // Retrieve recommendations related to the movie
        $recommendations = $movie->recommendations($limit);

        return response()->json($recommendations);
    }



public function getSimilarMovies(int $tmdb_id)
{
    // Query the similar_movies table directly
    $similarMovies = DB::table('similar_movies')
                        ->where('tmdb_id', $tmdb_id)
                        ->get();

    // Check if any similar movies were found
    if ($similarMovies->isEmpty()) {
        // Return a response indicating that no similar movies were found
        return response()->json(['message' => 'No similar movies found for the given movie'], 404);
    }

    // Return the similar movies as a JSON response
    return response()->json($similarMovies);
}

    



    public function newEloquentBuilder(Request $request, int $tmdb_id)
    {
        // Fetch movie details from the local database
        $movie = Movie::findOrFail($tmdb_id);

        // Perform any logic based on the request
        // ...

        return response()->json(['success' => true]);
    }

    public function getMovieRuntime(int $tmdb_id)
    {
        // Fetch movie details from the local database
        $movie = Movie::findOrFail($tmdb_id);

        // Retrieve runtime related to the movie
        $runtime = $movie->runtime();

        return response()->json(['runtime' => $runtime]);
    }

    public function getMoviePoster(int $tmdb_id)
    {
        // Fetch movie details from the local database
        $movie = Movie::findOrFail($tmdb_id);

        // Retrieve poster related to the movie
        $poster = $movie->poster();

        return response()->json($poster);
    }

    public function getMovieBackdrop(int $tmdb_id)
    {
        // Fetch movie details from the local database
        $movie = Movie::findOrFail($tmdb_id);

        // Retrieve backdrop related to the movie
        $backdrop = $movie->backdrop();

        return response()->json($backdrop);
    }

  







    public function store(Request $request, $tmdb_id)
    {
        // Validate the request
        $request->validate([
            // Your validation rules
        ]);

        // Create a new movie details and associate it with the specified movie
        $Movie = new Movie($request->all());
        $movie = Movie::findOrFail($tmdb_id);
        $movie->Movie()->save($Movie);

        return response()->json($Movie, 201);
    }
  
    public function show(int $tmdb_id)
    {
        $movie = Movie::findOrFail($tmdb_id);
        $Movie = $movie->Movie;

        return response()->json($movie);
    }


    
} 

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models;
use App\Models\MovieDetails;
use Illuminate\Support\Facades\DB;

class MovieDetailsController extends Controller
{
    public function nowPlaying(int $limit = 10)
    {
        // Fetch now playing movies from the local database
        $movie_details = MovieDetails::where('release_date', '<=', now())
            ->orderBy('release_date', 'desc')
            ->paginate($limit);

        return response()->json(['results' => $movie_details->items(), 'total_pages' => $movie_details->lastPage()]);
    }

    public function getPopularMovies(int $limit = 1000)
    {
        // Fetch popular movies from the local database
        $movies = MovieDetails::orderByDesc('popularity')
            ->paginate($limit);

        return response()->json(['results' => $movies->items(), 'total_pages' => $movies->lastPage()]);
    }

    public function getTopRatedMovies(int $limit = 1000)
    {
        // Fetch top-rated movies from the local database
        $movies = MovieDetails::orderByDesc('vote_average')
            ->paginate($limit);

        return response()->json(['results' => $movies->items(), 'total_pages' => $movies->lastPage()]);
    }

    public function getAllTopRatedMoviesPath(int $page=1000)
    {
        // Assuming you have a method or query to get top-rated movies
        $movies = MovieDetails::orderByDesc('vote_average')
        ->paginate($page);

        return response()->json(['results' => $movies->items(), 'total_pages' => $movies->lastPage()]);
    }
    
    public function getAllPopularMoviesPath(int $page=1000)
    {
        // Assuming you have a method or query to get top-rated movies
        $movies = MovieDetails::orderByDesc('popularity')
        ->paginate($page);

        return response()->json(['results' => $movies->items(), 'total_pages' => $movies->lastPage()]);
    }
    public function getAllNowPlayingMoviesPath(int $page=1000)
    {
        // Assuming you have a method or query to get top-rated movies
        $movies = MovieDetails::orderByDesc('release_date')
        ->paginate($page);

        return response()->json(['results' => $movies->items(), 'total_pages' => $movies->lastPage()]);
    }
    
   


    public function getUpcomingMovies(int $limit = 10)
    {
        // Fetch upcoming movies from the local database
        $movies = MovieDetails::where('release_date', '>', now())
            ->orderBy('release_date')
            ->paginate($limit);

        return response()->json(['results' => $movies->items(), 'total_pages' => $movies->lastPage()]);
    }

    public function getTrendingMovies(int $limit = 10)
    {
        // Fetch trending movies from the local database
        $movies = MovieDetails::orderByDesc('vote_average')
            ->paginate($limit);

        return response()->json(['results' => $movies->items(), 'total_pages' => $movies->lastPage()]);
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
        $movie = MovieDetails::findOrFail($tmdb_id);

        // Retrieve the collection related to the movie
        $collection = $movie->collection;

        return response()->json($collection);
    }
   
    public function getMovieDetails(int $tmdb_id)
{
    // Fetch movie details along with cast, similar movies, and reviews
    $movieDetails = MovieDetails::with('cast', 'similarMovies', 'reviews')->findOrFail($tmdb_id);

    return response()->json($movieDetails);
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


   



    public function fillFromLocal(Request $request, int $tmdb_id)
    {
        // Fetch movie details from the local database
        $movie = MovieDetails::findOrFail($tmdb_id);

        // Update the movie details
        $updated = $movie->fillFromLocal($request->all());

        return response()->json(['success' => $updated]);
    }

    public function updateFromLocal(Request $request, int $tmdb_id)
    {
        // Fetch movie details from the local database
        $movie = MovieDetails::findOrFail($tmdb_id);

        // Update the movie details
        $updated = $movie->updateFromLocal($request->input('locale'), $request->input('with', []));

        return response()->json(['success' => $updated]);
    }
    public function getMovieWatchProviders(int $tmdb_id, ?string $region = null)
    {
        // Fetch movie details from the local database
        $movie = MovieDetails::findOrFail($tmdb_id);

        // Retrieve watch providers related to the movie
        $watchProviders = $movie->watchProviders($region);

        return response()->json($watchProviders);
    }

    public function getMovieRecommendations(int $tmdb_id, ?int $limit = null)
    {
        // Fetch movie details from the local database
        $movie = MovieDetails::findOrFail($tmdb_id);

        // Retrieve recommendations related to the movie
        $recommendations = $movie->recommendations($limit);

        return response()->json($recommendations);
    }

   

    public function newEloquentBuilder(Request $request, int $tmdb_id)
    {
        // Fetch movie details from the local database
        $movie = MovieDetails::findOrFail($tmdb_id);

        // Perform any logic based on the request
        // ...

        return response()->json(['success' => true]);
    }

    public function getMovieRuntime(int $tmdb_id)
    {
        // Fetch movie details from the local database
        $movie = MovieDetails::findOrFail($tmdb_id);

        // Retrieve runtime related to the movie
        $runtime = $movie->runtime();

        return response()->json(['runtime' => $runtime]);
    }

    public function getMoviePoster(int $tmdb_id)
    {
        // Fetch movie details from the local database
        $movie = MovieDetails::findOrFail($tmdb_id);

        // Retrieve poster related to the movie
        $poster = $movie->poster();

        return response()->json($poster);
    }

    public function getMovieBackdrop(int $tmdb_id)
    {
        // Fetch movie details from the local database
        $movie = MovieDetails::findOrFail($tmdb_id);

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
        $movieDetails = new MovieDetails($request->all());
        $movie = MovieDetails::findOrFail($tmdb_id);
        $movie->movieDetails()->save($movieDetails);

        return response()->json($movieDetails, 201);
    }
  
    public function show(int $tmdb_id)
    {
        $movie = MovieDetails::findOrFail($tmdb_id);
        $movieDetails = $movie->movieDetails;

        return response()->json($movie);
    }


    
}

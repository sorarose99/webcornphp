<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CastController;
use Illuminate\Http\Request;
use App\Http\Controllers\MovieController;

use App\Http\Controllers\MovieDetailsController;
use App\Http\Controllers\TvShowsController;
use App\Http\Controllers\TVShowDetailsController;

use App\Http\Controllers\SearchController;


use App\Http\Controllers\IPTVChannelController;

Route::get('/channels', [IPTVChannelController::class, 'index']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/search/multi', [SearchController::class, 'search']);

Route::group(['prefix' => 'movie'], function () {
    Route::get('now_playing', [MovieController::class, 'nowPlaying']);
    Route::get('popular', [MovieController::class, 'getPopularMovie']);
    Route::get('top_rated', [MovieController::class, 'getTopRatedmovie']);
    Route::get('{tmdb_id}', [MovieController::class, 'getMovie']);
    Route::get('upcoming', [MovieController::class, 'getUpcomingMovies']);
    Route::get('trending', [MovieController::class, 'getTrendingMovies']);
    Route::get('{tmdb_id}/genres', [MovieController::class, 'getMovieGenres']);

Route::post('{tmdb_id}/fill-from-local', [MovieController::class, 'fillFromLocal']);
Route::post('{tmdb_id}/update-from-local', [MovieController::class, 'updateFromLocal']);

Route::get('{tmdb_id}/watch-providers', [MovieController::class, 'getMovieWatchProviders']);
Route::get('{tmdb_id}/recommendations', [MovieController::class, 'getMovieRecommendations']);
Route::get('{tmdb_id}/similars', [MovieController::class, 'getSimilarMovies']);

Route::post('{tmdb_id}/new-eloquent-builder', [MovieController::class, 'newEloquentBuilder']);

Route::post('{tmdb_id}/reviews', [ReviewController::class, 'store']);

Route::post('{tmdb_id}/movieDetails', [MovieDetailsController::class, 'store']);
Route::get('{tmdb_id}/movieDetails', [MovieDetailsController::class, 'show']);
    
});

Route::group(['prefix' => 'person'], function () {

    Route::get('{id}', [PersonController::class, 'getPersonDetails']);
    Route::get('trending', [PersonController::class,'getTrendingPeople']);
    Route::put('{id}/update', [PersonController::class,'updatePersonDetails']);





});






    
Route::group(['prefix' => 'movieDetails'], function () {


  

    Route::get('now_playing&page={page}', [MovieDetailsController::class, 'getAllNowPlayingMoviesPath']);
    Route::get('popular&page={page}', [MovieDetailsController::class, 'getAllPopularMoviesPath']);
    Route::get('top_rated&page={page}', [MovieDetailsController::class, 'getAllTopRatedMoviesPath']);
    // Route::get('{tmdb_id}', [MovieController::class, 'getMovie']);
    Route::get('upcoming', [MovieDetailsController::class, 'getUpcomingMovies']);
    Route::get('trending', [MovieDetailsController::class, 'getTrendingMovies']);
    Route::get('{tmdb_id}/genres', [MovieDetailsController::class, 'getMovieGenres']);

    Route::get('{tmdb_id}', [MovieDetailsController::class, 'getMovieDetails']);
    // Route::get('{tmdb_id}', [MovieDetailsController::class, 'getReview']);
    // Route::get('{tmdb_id}/similars', [MovieDetailsController::class, 'getSimilarMovies']);


Route::post('{tmdb_id}/fill-from-local', [MovieDetailsController::class, 'fillFromLocal']);
Route::post('{tmdb_id}/update-from-local', [MovieDetailsController::class, 'updateFromLocal']);

Route::get('{tmdb_id}/watch-providers', [MovieDetailsController::class, 'getMovieWatchProviders']);
Route::get('{tmdb_id}/recommendations', [MovieDetailsController::class, 'getMovieRecommendations']);

Route::post('{tmdb_id}/new-eloquent-builder', [MovieDetailsController::class, 'newEloquentBuilder']);



    
});





    
Route::group(['prefix' => 'tv'], function () {
    Route::get('on_the_air', [TvShowsController::class, 'on_the_air']);
    Route::get('popular', [TvShowsController::class, 'getPopularTV']);
    Route::get('top_rated', [TvShowsController::class, 'getTopRatedTV']);
    
});


Route::group(['prefix' => 'tv-details'], function () {
    Route::get('{tmdb_id}/season/{season_number}', [TVShowDetailsController::class, 'getSeasonDetailsPath']);
    
    Route::get('popular&page={page}', [TVShowDetailsController::class, 'getAllPopularTvShowsPath']);
    Route::get('top_rated&page={page}', [TVShowDetailsController::class, 'getAllTopRatedTvShowsPath']);
    Route::get('{tmdb_id}', [TVShowDetailsController::class, 'getTV']);
    
});
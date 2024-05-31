<?php
namespace App\Models;


use Carbon\CarbonInterval;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;



class MovieDetails extends Model
{
    
    protected $primaryKey = 'tmdb_id';
    protected $table = 'movie_details';
   
    protected $fillable = [
        'tmdb_id',
        'adult',
        'backdrop_path',
        'budget',
        'homepage',
        'imdb_id',
        'original_language',
        'original_title',
        'overview',
        'popularity',
        'poster_path',
        'release_date',
        'revenue',
        'video',
        'runtime',
        'vote_average',
        'vote_count',
        'production_countries',
        'spoken_languages',
        'tagline',
        'status',
        'collection_id',
        'videoUrl'
    ];

    public function movie()
    {
        return $this->belongsTo(Movie::class, 'tmdb_id');
    }

    public function cast()
    {
        return $this->hasMany(Cast::class, 'tmdb_id', 'tmdb_id');
    }
   
    public function reviews()
    {
        return $this->hasMany(Review::class, 'tmdb_id', 'tmdb_id');
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'movie_genres', 'tmdb_id', 'genre_id');
    }

    public function similarMovies()
{
    return $this->hasMany(SimilarMovie::class, 'tmdb_id', 'tmdb_id');
}



    
    // public function movie()
    // {
    //     return $this->belongsTo(Movie::class, 'tmdb_id');
    // }
    // public function cast()
    // {
    //     return $this->hasMany(Cast::class, 'tmdb_id', 'tmdb_id');
    // }
    // public function review()
    // {
    //     return $this->hasMany(review::class, 'tmdb_id', 'tmdb_id');
    // }
  
    // public function genres()
    // {
    //     return $this->belongsToMany(Genre::class, 'movie_genres');
    // }
    // public function similarMovies()
    // {
    //     return $this->belongsToMany(MovieDetails::class, 'similar_movies', 'tmdb_id', 'similar_movie_id');
    // }
    
    
    

    public static function popular(?int $limit): EloquentCollection
    {
        // Replace this query with your actual database query
        $popularMovies = DB::table('movie_details')
            ->orderByDesc('popularity')
            ->when($limit, fn ($query) => $query->limit($limit))
            ->get();

        return new EloquentCollection($popularMovies);
    }

    public static function toprated(?int $limit): EloquentCollection
    {
        // Replace this query with your actual database query
        $topRatedMovies = DB::table('movie_details')
            ->orderByDesc('vote_average')
            ->when($limit, fn ($query) => $query->limit($limit))
            ->get();

        return new EloquentCollection($topRatedMovies);
    }



    public static function upcoming(?int $limit): EloquentCollection
    {
        // Replace this query with your actual database query
        $upcomingMovies = DB::table('movie_details')
            ->where('release_date', '>', now())
            ->orderBy('release_date')
            ->when($limit, fn ($query) => $query->limit($limit))
            ->get();

        return new EloquentCollection($upcomingMovies);
    }

    public static function trending(?int $limit, string $window = 'day'): EloquentCollection
    {
        // Replace this query with your actual database query
        $trendingMovies = DB::table('movie_details')
            ->orderByDesc('popularity')
            ->when($limit, fn ($query) => $query->limit($limit))
            ->get();

        return new EloquentCollection($trendingMovies);
    }

    public static function nowPlaying(?int $limit): EloquentCollection
    {
        $nowPlayingMovies = DB::table('movie_details')
            ->whereDate('release_date', '<=', now())
            ->orderByDesc('release_date')
            ->when($limit, fn ($query) => $query->limit($limit))
            ->get();
    
        return new EloquentCollection($nowPlayingMovies);
    }
    
    public function genre(): BelongsToMany
    {
        return $this->belongsToMany(MovieGenre::class, 'movie_movie_genre');
    }
    
    public function collection(): BelongsTo
    {
        return $this->belongsTo(Collection::class);
    }
    
    public function credits(): MorphManyCredits
    {
        $creditInstance = $this->newRelatedInstance(Credit::class);
    
        return new MorphManyCredits(
            $creditInstance->newQuery(),
            $this,
            $creditInstance->qualifyColumn('media_type'),
            $creditInstance->qualifyColumn('media_id'),
            $this->getKeyName()
        );
    }
    
   
    
    public function crew(): MorphManyCredits
    {
        return $this->credits()->whereCreditType(CreditType::CREW());
    }
    
    public function fillFromLocal(array $data, ?string $locale = null): static
{
    $this->fill([
        'id' => $data['id'],
        'adult' => $data['adult'],
        'backdrop_path' => $data['backdrop_path'] ?: null,
        'budget' => $data['budget'] ?: null,
        'homepage' => $data['homepage'] ?: null,
        'imdb_id' => trim($data['imdb_id']) ?: null,
        'original_language' => $data['original_language'] ?: null,
        'original_title' => $data['original_title'] ?: null,
        'popularity' => $data['popularity'] ?: null,
        'release_date' => $data['release_date'] ?: null,
        'revenue' => $data['revenue'] ?: null,
        'video' => $data['video'],
        'runtime' => $data['runtime'] ?: null,
        'vote_average' => $data['vote_average'] ?: null,
        'vote_count' => $data['vote_count'] ?: 0,
        'production_countries' => $data['production_countries'] ?? [],
        'spoken_languages' => $data['spoken_languages'] ?? [],
        'status' => $data['status'] ?: null,
    ]);

    $locale ??= $this->getLocale();

    $this->setTranslation('overview', $locale, trim($data['overview']) ?: null);
    $this->setTranslation('tagline', $locale, trim($data['tagline']) ?: null);
    // $this->setTranslation('title', $locale, trim($data['title']) ?: null);
    $this->setTranslation('poster_path', $locale, trim($data['poster_path']) ?: null);

    return $this;
}

public function updateFromLocal(?string $locale = null, array $with = []): bool
{
    // Replace this with logic to retrieve movie data from your local database
    $data = $this->toArray();

    if (empty($data)) {
        return false; // No data available in the local database
    }

    // Update the movie details
    if (!$this->fillFromLocal($data, $locale)->save()) {
        return false;
    }

    // Sync genres
    $this->genres()->sync(
        collect($data['genres'] ?? [])
            ->map(static function (array $data) use ($locale): MovieGenre {
                $genre = MovieGenre::query()->findOrNew($data['id']);
                $genre->fillFromLocal($data, $locale)->save();

                return $genre;
            })
            ->pluck('id')
    );

    // Associate collection
    if ($data['collection_id']) {
        $this->collection()->associate(
            Collection::query()->findOrFail($data['collection_id'])
        )->save();
    }

    // Check and update credits
    if (in_array('credits', $with) || in_array('cast', $with) || in_array('crew', $with)) {
        foreach ($data['credits']['cast'] as $cast) {
            Credit::query()->findOrNew($cast['credit_id'])->save();
        }

        foreach ($data['credits']['crew'] as $crew) {
            Credit::query()->findOrNew($crew['credit_id'])->save();
        }
    }

    return true;
}

public function poster(): Poster
{
    $poster = new Poster(
        $this->poster_path,
        $this->title
    );

    // Log or dump the poster path for debugging

    return $poster;
}

public function backdrop(): Backdrop
{
    return new Backdrop(
        $this->backdrop_path,
        $this->title
    );
}
public function original_title(): original_title
{
    return new original_title(
        $this->original_title
    );
}
public function recommendations(?int $limit): EloquentCollection
{
    // Assuming you have a 'recommendations' relationship defined in your Movie model
    $recommendations = $this->recommendations()->limit($limit)->get();

    return $recommendations;
}
public function similars(?int $limit): EloquentCollection
{
    // Assuming you have a 'similars' relationship defined in your Movie model
    $similars = $this->similars()->limit($limit)->get();

    return $similars;
}

public function watchProviders(?string $region = null, ?WatchProviderType $type = null): EloquentCollection
{
    // Assuming you have a 'watchProviders' relationship defined in your Movie model
    $watchProviders = $this->watchProviders()->get();

    return $watchProviders;
}




// Add the 'topRated' scope in your MovieBuilder
public function scopeTopRated($query)
{
    return $query->orderByDesc('vote_average');
}
}
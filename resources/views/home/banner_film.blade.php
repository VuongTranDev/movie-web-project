@foreach ($popularFilm as $movie)
    <a href="{{ route('movie.details', ['slug' => $movie['slug']]) }}" style="text-decoration: none;">
        <div class="d-flex mb-2 thumb-movie-popular">
            <img src="{{ $movie['thumb_url'] }}" class="img-film-popular" alt="{{ $movie['name'] }}">
            <div class="info-film-popular">
                <h3 class="name-film">{{ $movie['name'] }}</h3>
                <p>{{ $movie['year'] }}</p>
            </div>
        </div>
    </a>
@endforeach

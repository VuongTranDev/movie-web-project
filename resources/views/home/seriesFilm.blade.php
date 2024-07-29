<div class="row">
    <div class="d-flex justify-content-between align-items-center mt-3 ">
        <h5 class="ms-3">PHIM BỘ</h5>
        <a href="{{ route('movie.categorys', ['slug' => 'phim-bo']) }}" class="text-color-light" style="color: #fff; font-size: 12px;">Xem thêm</a>
    </div>
    <div class="movie-newly d-flex flex-wrap">
        @foreach ($seriesFilm as $movie)
            <div class="col-6 col-md-6 col-lg-3 mb-2 p-2">
                <a href="{{ route('movie.details', ['slug' => $movie['slug']]) }}">
                    <div class="movie-card">
                        <p class="quantity-title">
                            @if (str_contains($movie['current_episode'], 'Hoàn tất'))
                                {{ $movie['current_episode'] }}
                            @else
                                {{ $movie['current_episode'] }}/{{ $movie['total_episodes'] }}
                            @endif
                        </p>

                        <img src="{{ $movie['thumb_url'] }}" class="img-film-newly" alt="{{ $movie['name'] }}">
                        <div class="info">
                            <h5 class="movie-name-thumb">{{ $movie['name'] }}</h5>
                            <p>{{ $movie['year'] }}</p>
                        </div>
                        <span class="badge">{{ $movie['quality'] }} {{ $movie['language'] }}</span>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>

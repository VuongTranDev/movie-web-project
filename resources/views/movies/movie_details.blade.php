@extends('layouts.app')

@section('renderBody')
    <link rel="stylesheet" href="../../css/style.css">
    <div class="container-xl" style="margin-top: 66px;">
        <div class="row">
            <div class="col-9 mt-3">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="mb-3 mt-3" data-aos="fade-up">
                    <div class="breadcrumb-custom">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item breadcrumb-item-home d-flex align-items-center">
                                <a href="/">
                                    <svg aria-hidden="true" class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg"
                                        style="width: 16px; height: 16px; margin-bottom: 5px;">
                                        <path
                                            d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                                        </path>
                                    </svg>
                                    Movie Land
                                </a>
                            </li>
                            <li class="breadcrumb-item breadcrumb-item-category">
                                <a href="/">
                                    @if (isset($movie['category']['4']) && isset($movie['category']['4']['list']))
                                        @foreach ($movie['category']['4']['list'] as $item)
                                            {{ $item['name'] }}
                                            @if (!$loop->last)
                                                ,
                                            @endif
                                        @endforeach
                                    @endif
                                </a>
                            </li>
                            <li class="breadcrumb-item breadcrumb-item-active" aria-current="page">{{ $movie['name'] }}
                            </li>
                        </ol>
                    </div>
                </nav>

                <div class="row"
                    style="padding-bottom: 10px; box-shadow: 0 6px 8px rgba(0, 0, 0, 0.3); border-radius: 10px;">
                    <div class="col-4">
                        <img src="{{ $movie['thumb_url'] }}" class="img-detail-movie" alt="{{ $movie['name'] }}">
                    </div>
                    <div class="col-8">
                        <h3 class="name-movie-detail">{{ $movie['name'] }}</h3>
                        <p>{{ $movie['original_name'] }}</p>
                        <div class="d-flex">
                            <p class="me-2">Số tập: </p>
                            <p class="total-episode">
                                @if (str_contains($movie['current_episode'], 'Hoàn tất'))
                                    {{ $movie['current_episode'] }}
                                @else
                                    {{ $movie['current_episode'] }}/{{ $movie['total_episodes'] }}
                                @endif
                            </p>
                        </div>

                        <p>
                            {{ $movie['year'] }} ·
                            @if (isset($movie['category']['4']) && isset($movie['category']['4']['list']))
                                @foreach ($movie['category']['4']['list'] as $item)
                                    {{ $item['name'] }}
                                    @if (!$loop->last)
                                        ,
                                    @endif
                                @endforeach
                            @endif
                        </p>
                        <p>
                            @if (isset($movie['category']))
                                @foreach ($movie['category'] as $category)
                                    @if (isset($category['4']))
                                        @foreach ($category['4'] as $nation)
                                            @if (isset($nation['list']))
                                                @foreach ($nation['list'] as $item)
                                                    {{ $item['name'] }}
                                                @endforeach
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            @endif
                        </p>
                        <p>Thể loại:
                            @if (isset($movie['category']['2']) && isset($movie['category']['2']['list']))
                                @foreach ($movie['category']['2']['list'] as $item)
                                    {{ $item['name'] }}
                                    @if (!$loop->last)
                                        ,
                                    @endif
                                @endforeach
                            @endif
                        </p>
                        <p>Chất lượng: {{ $movie['quality'] }}</p>

                        <div class="btn-watch-now" style="clear: both;">
                            @php
                                $firstEpisode = null;
                                if (count($movie['episodes']) > 0) {
                                    $firstServer = $movie['episodes'][0];
                                    if (count($firstServer['items']) > 0) {
                                        $firstEpisode = $firstServer['items'][0];
                                    }
                                }

                                foreach ($movie['episodes'] as $item) {
                                    $server = $item['server_name'];
                                }
                            @endphp

                            @if ($firstEpisode)
                                <a
                                    href="{{ route('movie.watch', ['slug' => $movie['slug'], 'episode' => $firstEpisode['slug'], 'server_name' => $server]) }}">
                                    <i>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6"
                                            style="width: 30px; height: 25px;">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.348a1.125 1.125 0 010 1.971l-11.54 6.347a1.125 1.125 0 01-1.667-.985V5.653z">
                                            </path>
                                        </svg>
                                    </i>
                                    Xem ngay
                                </a>
                            @else
                                <p>Không có tập phim để xem.</p>
                            @endif
                        </div>

                    </div>
                </div>

                @include('movies.details_group')

                <div class="row">
                    <h5 class="mt-4 ms-3">PHIM MỚI</h5>
                    <div class="movie-carousel-new-film">
                        @foreach ($newFilm as $movie)
                            <div class="col pe-3">
                                <a href="{{ route('movie.details', ['slug' => $movie['slug']]) }}">
                                    <div class="movie-card">
                                        <img src="{{ $movie['thumb_url'] }}" class="img-film-new"
                                            alt="{{ $movie['name'] }}">
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

            </div>
            <div class="col-3" style="margin-top: 75px;">
                <h5 class="mt-3 mb-4">CÓ THỂ BẠN MUỐN XEM</h5>
                @include('home.banner_film')
            </div>
        </div>
    </div>
@endsection



<style>
    .nav-link-tab.active {
        background-color: #ec8f00 !important;
        color: #ffffff !important;
    }

    .nav-link-tab {
        background-color: #52525252 !important;
        opacity: 0.8;
        color: #fff !important;
        margin: 5px;
        box-shadow: 0 6px 8px rgba(0, 0, 0, 0.3);
    }

    .nav-link-tab:hover {
        color: #fff !important;
    }

    .tab-pane {
        background-color: #40404040;
        padding: 10px;
        border-radius: 10px;
        box-shadow: 0 6px 8px rgba(0, 0, 0, 0.3);
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
<!-- Slick JS -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.movie-carousel-new-film').slick({
            slidesToShow: 6,
            slidesToScroll: 1,
            dots: true,
            arrows: true,
            infinite: true,
            autoplay: true,
            autoplaySpeed: 4500,
            responsive: [{
                breakpoint: 768,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1
                }
            }]
        });
    });
</script>

@extends('layouts.app')

@section('renderBody')
    <link rel="stylesheet" href="../../css/style.css">
    <div class="container-xl" style="margin-top: 66px;">
        <div class="row">
            <div class="col-9 mt-3">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="mb-3 mt-3" data-aos="fade-up">
                    <div class="breadcrumb-custom">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item breadcrumb-item-category d-flex align-items-center">
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
                            <li class="breadcrumb-item breadcrumb-item-category">
                                <a href="/">
                                    {{$movie['name']}}
                                </a>
                            </li>
                            <li class="breadcrumb-item breadcrumb-item-active" aria-current="page">Tập {{ $episodeData['name'] }}
                            </li>
                        </ol>
                    </div>
                </nav>

                <div class="row"
                    style="padding-bottom: 10px; box-shadow: 0 6px 8px rgba(0, 0, 0, 0.3); border-radius: 10px;">
                    <div class="col-12">
                        
                        <iframe src="{{ $episodeData['embed'] }}" frameborder="0" width="100%" height="600px"
                            allowfullscreen></iframe>
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

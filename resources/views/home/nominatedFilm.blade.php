<link rel="stylesheet" href="../../css/style.css">

<div class="row">
    <h5 class="mt-4 ms-3">PHIM ĐỀ CỬ</h5>
    <div class="movie-carousel">
        @foreach ($moviesNowShowing as $movie)
            <div class="col pe-3">
                <a href="{{ route('movie.details', ['slug' => $movie['slug']]) }}">
                    <div class="movie-card">
                        <img src="{{ $movie['thumb_url'] }}" class="img-film-nowshowing" alt="{{ $movie['name'] }}">
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
<!-- Slick JS -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.movie-carousel').slick({
            slidesToShow: 5,
            slidesToScroll: 1,
            dots: true,
            arrows: true,
            infinite: true,
            autoplay: true,
            autoplaySpeed: 4500,
            responsive: [{
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            }]
        });
    });
</script>

<style>
    .img-film-nowshowing {
        height: 320px;
    }
</style>

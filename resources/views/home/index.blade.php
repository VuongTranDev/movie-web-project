@include('home.nominatedFilm')
<div class="row">
    <div class="col-lg-9">
        @include('home.newlyUpdateFilm')
        @include('home.singleFilm')
        @include('home.seriesFilm')
    </div>

    <div class="col-lg-3">
        <div class="row">
            <h5 class="mt-3 mb-4">NĂM PHÁT HÀNH</h5>
            @foreach ($yearOfManufacture as $years)
                <div class="col-lg-3 mb-3">
                    <div class="btn-year"><a href="{{ route('movie.year', ['slug' => $years->year]) }}">{{ $years->year }}</a></div>
                </div>
            @endforeach

            <h5 class="mt-3 mb-4">THỊNH HÀNH</h5>
            @include('home.banner_film')
        </div>
    </div>
</div>
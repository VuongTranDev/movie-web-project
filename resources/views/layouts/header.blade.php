<header>
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);">
        <div class="container-xl">
            <a class="navbar-brand pe-4" href="/"><img src="{{ URL('images/logo.png') }}" alt="logo shop"
                    width="150" height="40"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
                aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll flex justify-content-between">
                    <li class="nav-item pe-3">
                        <a class="nav-link" aria-current="page"
                            href="{{ route('movie.categorys', ['slug' => 'phim-dang-chieu']) }}">Phim mới</a>
                    </li>
                    <li class="nav-item pe-3">
                        <a class="nav-link" href="{{ route('movie.categorys', ['slug' => 'phim-le']) }}">Phim lẻ</a>
                    </li>
                    <li class="nav-item pe-3">
                        <a class="nav-link" href="{{ route('movie.categorys', ['slug' => 'phim-bo']) }}">Phim bộ</a>
                    </li>
                    <li class="nav-item dropdown pe-3">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Thể loại
                        </a>
                        <ul class="dropdown-menu pe-3">
                            @foreach ($type_movie_data as $type)
                                <li><a class="dropdown-item"
                                        href="{{ route('movie.types', ['slug' => $type->key_type]) }}">{{ $type->name_type }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="nav-item dropdown pe-3">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Quốc gia
                        </a>
                        <ul class="dropdown-menu pe-3">
                            @foreach ($country_data as $country)
                                <li><a class="dropdown-item"
                                        href="{{ route('movie.countrys', ['slug' => $country->key_country]) }}">{{ $country->name_country }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
                <form class="d-flex justify-content-between search" role="search" action="{{ route('movies.search') }}"
                    method="GET" autocomplete="off">
                    <input class="me-2 search-txt" type="text" placeholder="Tìm kiếm..." aria-label="Search"
                        name="query" value="{{ request('query') }}">
                    <a class="search-btn" href="#">
                        <i class="fas fa-search"></i>
                    </a>
                </form>
            </div>
        </div>
    </nav>
</header>
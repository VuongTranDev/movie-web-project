@extends('layouts.app')
@section('renderBody')
    <div class="row">
        <div class="col-lg-9">
            @if (count($movies) > 0)
                <div class="row">
                    <div class="movie-newly d-flex flex-wrap">
                        @foreach ($movies as $movie)
                            <div class="col-6 col-md-6 col-lg-3 mb-2 p-2">
                                <a href="{{ route('movie.details', ['slug' => $movie['slug']]) }}">
                                    <div class="movie-card">
                                        <img src="{{ $movie['thumb_url'] }}" class="img-film-newly"
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

                <div class="paginate-container d-flex justify-content-center">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <!-- Previous Page Link -->
                            @if ($page > 1)
                                <li class="page-item">
                                    <a class="page-link"
                                        href="{{ route('movie.categorys', ['slug' => $slug, 'page' => $page - 1]) }}"
                                        aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <span class="page-link" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </span>
                                </li>
                            @endif

                            <!-- Page Number Links -->
                            @php
                                $startPage = max(1, $page - 1);
                                $endPage = min($totalPages, $page + 1);
                            @endphp

                            <!-- First Page Link -->
                            @if ($startPage > 1)
                                <li class="page-item">
                                    <a class="page-link"
                                        href="{{ route('movie.categorys', ['slug' => $slug, 'page' => 1]) }}">1</a>
                                </li>
                                @if ($startPage > 2)
                                    <li class="page-item disabled">
                                        <span class="page-link">...</span>
                                    </li>
                                @endif
                            @endif

                            <!-- Display Pages Close to Current Page -->
                            @for ($i = $startPage; $i <= $endPage; $i++)
                                <li class="page-item {{ $i == $page ? 'active' : '' }}">
                                    <a class="page-link"
                                        href="{{ route('movie.categorys', ['slug' => $slug, 'page' => $i]) }}">
                                        {{ $i }}
                                    </a>
                                </li>
                            @endfor

                            <!-- Last Page Link -->
                            @if ($endPage < $totalPages)
                                @if ($endPage < $totalPages - 1)
                                    <li class="page-item disabled">
                                        <span class="page-link">...</span>
                                    </li>
                                @endif
                                <li class="page-item">
                                    <a class="page-link"
                                        href="{{ route('movie.categorys', ['slug' => $slug, 'page' => $totalPages]) }}">{{ $totalPages }}</a>
                                </li>
                            @endif

                            <!-- Next Page Link -->
                            @if ($page < $totalPages)
                                <li class="page-item">
                                    <a class="page-link"
                                        href="{{ route('movie.categorys', ['slug' => $slug, 'page' => $page + 1]) }}"
                                        aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <span class="page-link" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </span>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>
            @else
                <p>Không tìm thấy phim nào.</p>
            @endif
        </div>
        <div class="col-lg-3">
            @include('home.banner_film')
        </div>
    </div>
@endsection

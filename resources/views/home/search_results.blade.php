@extends('layouts.app')

@section('renderBody')
    <h1>Kết quả tìm kiếm cho "{{ $query }}"</h1>

    @if (count($movies) > 0)
        <div class="row">
            <div class="movie-newly d-flex flex-wrap">
                @foreach ($movies as $movie)
                    <div class="col-6 col-md-6 col-lg-2 mb-2 p-2">
                        <a href="{{ route('movie.details', ['slug' => $movie['slug']]) }}">
                            <div class="movie-card">
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
        <div class="paginate-container d-flex justify-content-center">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <!-- Previous Page Link -->
                    @if ($page > 1)
                        <li class="page-item">
                            <a class="page-link"
                                href="{{ route('movies.search', ['query' => $query, 'page' => $page - 1]) }}"
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
                            <a class="page-link" href="{{ route('movies.search', ['query' => $query, 'page' => 1]) }}">1</a>
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
                            <a class="page-link" href="{{ route('movies.search', ['query' => $query, 'page' => $i]) }}">
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
                                href="{{ route('movies.search', ['query' => $query, 'page' => $totalPages]) }}">{{ $totalPages }}</a>
                        </li>
                    @endif

                    <!-- Next Page Link -->
                    @if ($page < $totalPages)
                        <li class="page-item">
                            <a class="page-link"
                                href="{{ route('movies.search', ['query' => $query, 'page' => $page + 1]) }}"
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

    <style>
        .pagination .page-item.active .page-link {
            background-color: #ec8f00;
            color: #ffffff;
        }

        .pagination .page-item.disabled .page-link {
            background-color: #42424288;
        }

        .pagination .page-link {
            margin: 5px;
            width: 40px;
            display: flex;
            justify-content: center;
            color: #fff
        }

        .page-item .page-link {
            background-color: #6e6e6e88;
            border: 1px solid #41414144;
            border-radius: 5px;
        }

        .pagination .page-link:hover {
            background-color: #000;
        }
    </style>

@endsection

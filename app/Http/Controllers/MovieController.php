<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class MovieController extends Controller
{
    private function fetchMovieData($slug)
    {
        $url = "https://phim.nguonc.com/api/film/{$slug}";

        $maxRetries = 3;
        $retryDelay = 5;

        for ($attempt = 0; $attempt < $maxRetries; $attempt++) {
            $response = Http::get($url);

            if ($response->successful()) {
                $data = $response->json();

                if (isset($data['status']) && $data['status'] === 'success') {
                    $movie = $data['movie'];
                    $movie['year'] = date('Y', strtotime($movie['created']));
                    return $movie;
                }

                return null;
            } elseif ($response->status() === 429) {
                sleep($retryDelay);
            } else {
                return null;
            }
        }

        return null;
    }

    private function getMovies($url, $cacheKey, $minutes = 120)
    {
        return Cache::remember($cacheKey, $minutes, function () use ($url) {
            $response = Http::get($url);
            $data = $response->json();

            if (isset($data['items'])) {
                $movies = $data['items'];
                foreach ($movies as &$movie) {
                    $movie['year'] = date('Y', strtotime($movie['created']));
                }
                return $movies;
            }
            return [];
        });
    }

    private function getCommonData()
    {
        $type_movie_data = DB::table('type_movie')->get();
        $country_data = DB::table('country')->get();
        $popularMovie = $this->getMovies("https://phim.nguonc.com/api/films/phim-moi-cap-nhat", "newly_updated_movies");
        $newFilm = $this->getMovies("https://phim.nguonc.com/api/films/phim-moi-cap-nhat?page=2", "movies_now_showing");
        $popularFilm = array_slice($popularMovie, 0, 8);

        return compact('type_movie_data', 'country_data', 'popularFilm', 'newFilm');
    }

    private function getPaginatedMovies($url)
    {
        $response = Http::get($url);
        $data = $response->json();

        $movies = [];
        $totalPages = 1;

        $full_data = $data;

        if (isset($data['items'])) {
            $movies = $data['items'];
            foreach ($movies as &$movie) {
                $movie['year'] = date('Y', strtotime($movie['created']));
            }
        }

        if (isset($data['paginate'])) {
            $paginate = $data['paginate'];
            $totalPages = $paginate['total_page'] ?? 1;
        }

        return compact('movies', 'totalPages', 'full_data');
    }

    public function showMovieDetails($slug)
    {
        $commonData = $this->getCommonData();
        $movie = $this->fetchMovieData($slug);

        return view('movies.movie_details', array_merge($commonData, compact('movie')));
    }

    public function showWatchMovie($slug, $episode, Request $request)
    {
        $commonData = $this->getCommonData();
        $server_name = $request->input('server_name');
        $movie = $this->fetchMovieData($slug);

        $currentEpisode = $episode;
        $currentServer = $server_name;

        $episodeData = null;
        foreach ($movie['episodes'] as $server_total) {
            if ($server_total['server_name'] === $server_name) {
                foreach ($server_total['items'] as $item) {
                    if ($item['slug'] === $episode) {
                        $episodeData = $item;
                        break 2;
                    }
                }
            }
        }

        if (!$episodeData) {
            abort(404, 'Episode not found');
        }

        return view('movies.watch_movie', array_merge($commonData, compact('movie', 'episodeData', 'episode', 'server_name', 'currentEpisode', 'currentServer')));
    }

    public function movieByType($slug, Request $request)
    {
        $commonData = $this->getCommonData();
        $page = (int) $request->input('page', 1);
        $url = "https://phim.nguonc.com/api/films/the-loai/{$slug}?page={$page}";
        $paginatedMovies = $this->getPaginatedMovies($url);

        return view('movies.movieByType', array_merge($commonData, $paginatedMovies, compact('page', 'slug')));
    }

    public function movieByCountry($slug, Request $request)
    {
        $commonData = $this->getCommonData();
        $page = (int) $request->input('page', 1);
        $url = "https://phim.nguonc.com/api/films/quoc-gia/{$slug}?page={$page}";
        $paginatedMovies = $this->getPaginatedMovies($url);

        return view('movies.movieByCountry', array_merge($commonData, $paginatedMovies, compact('page', 'slug')));
    }

    public function movieByCategory($slug, Request $request)
    {
        $commonData = $this->getCommonData();
        $page = (int) $request->input('page', 1);
        $url = "https://phim.nguonc.com/api/films/danh-sach/{$slug}?page={$page}";
        $paginatedMovies = $this->getPaginatedMovies($url);

        return view("movies.movieByCategory", array_merge($commonData, $paginatedMovies, compact("page", "slug")));
    }

    public function movieByNewlyUpdate($slug, Request $request)
    {
        $commonData = $this->getCommonData();
        $page = (int) $request->input('page', 1);
        $url = "https://phim.nguonc.com/api/films/{$slug}?page={$page}";
        $paginatedMovies = $this->getPaginatedMovies($url);

        return view("movies.movieByNewlyUpdate", array_merge($commonData, $paginatedMovies, compact("page", "slug")));
    }

    public function movieByYear($slug, Request $request)
    {
        $commonData = $this->getCommonData();
        $page = (int) $request->input('page', 1);
        $url = "https://phim.nguonc.com/api/films/nam-phat-hanh/{$slug}?page={$page}";
        $paginatedMovies = $this->getPaginatedMovies($url);

        return view("movies.movieByNewlyUpdate", array_merge($commonData, $paginatedMovies, compact("page", "slug")));
    }
}

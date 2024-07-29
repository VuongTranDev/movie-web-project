<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function getMovies($url, $cacheKey, $minutes = 120)
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
            } else {
                return [];
            }
        });
    }

    public function index()
    {
        $moviesNowShowing = $this->getMovies('https://phim.nguonc.com/api/films/danh-sach/phim-dang-chieu', 'movies_now_showing');
        $newlyUpdatedMovies = $this->getMovies('https://phim.nguonc.com/api/films/phim-moi-cap-nhat', 'newly_updated_movies');
        $singleFilm = $this->getMovies('https://phim.nguonc.com/api/films/the-loai/phim-le', 'single_film');
        $seriesFilm = $this->getMovies('https://phim.nguonc.com/api/films/the-loai/phim-bo', 'series_film');
        $popularFilm = $this->getMovies('https://phim.nguonc.com/api/films/phim-moi-cap-nhat?page=2', 'popular_film');
        $yearOfManufacture = DB::table('year')->orderByDesc('year_id')->get();
        $type_movie_data = DB::table('type_movie')->get();
        $country_data = DB::table('country')->get();

        $newlyUpdatedMovies = array_slice($newlyUpdatedMovies, 0, 8);
        $singleFilm = array_slice($singleFilm, 0, 4);
        $seriesFilm = array_slice($seriesFilm, 0, 4);

        return view("index", compact("moviesNowShowing", "newlyUpdatedMovies", "singleFilm", "seriesFilm", 'yearOfManufacture', 'popularFilm', 'type_movie_data', 'country_data'));
    }

    public function search(Request $request)
    {
        $type_movie_data = DB::table('type_movie')->get();
        $country_data = DB::table('country')->get();
        $query = $request->input('query');
        $page = (int) $request->input('page', 1);

        if (empty($query)) {
            return redirect()->back()->with('error', 'Bạn chưa nhập từ khóa tìm kiếm.');
        }

        $url = "https://phim.nguonc.com/api/films/search?keyword=" . urlencode($query) . "&page=" . $page;

        $response = Http::get($url);
        $data = $response->json();

        $movies = [];
        $totalPages = 1;

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
        // dd($movies);

        return view('home.search_results', compact('movies', 'query', 'totalPages', 'page', 'type_movie_data', 'country_data'));
    }
}

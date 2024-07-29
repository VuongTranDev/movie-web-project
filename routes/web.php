<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MovieController;

Route::get("/", [
    HomeController::class,
    "index"
]);

Route::get('/watch/{slug}/{episode}', [
    MovieController::class,
    'showWatchMovie'
])->name('movie.watch');

Route::get('/movie/{slug}', [
    MovieController::class, 
    'showMovieDetails'
])->name('movie.details');

Route::get('/search', [
    HomeController::class, 
    'search'
])->name('movies.search');

Route::get('/the-loai/{slug}', [
    MovieController::class, 
    'movieByType'
])->name('movie.types');

Route::get('/quoc-gia/{slug}', [
    MovieController::class,
    'movieByCountry',
])->name('movie.countrys');

Route::get('/danh-sach/{slug}', [
    MovieController::class,
    'movieByCategory',
])->name('movie.categorys');

Route::get('/update/{slug}', [
    MovieController::class,
    'movieByNewlyUpdate',
])->name('movie.newlyUpdate');

Route::get('/nam-phat-hanh/{slug}', [
    MovieController::class,
    'movieByYear',
])->name('movie.year');
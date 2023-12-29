<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\SocialController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\FacebookController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//login face
Route::get('/dang-nhap', [IndexController::class, 'getdangnhap'])->name('dang-nhap');
Route::get('/dang-ky', [IndexController::class, 'getdangky'])->name('dang-ky');

Route::post('/dang-nhap', [IndexController::class, 'postdangnhap'])->name('dang-nhap');
Route::post('/dang-ky', [IndexController::class, 'postdangky'])->name('dang-ky');

Route::get('/dang-xuat', [IndexController::class, 'getlogout'])->name('dang-xuat');
 
Route::get('/', [IndexController::class, 'home'])->name('homepage');
Route::get('/danh-muc/{slug}', [IndexController::class, 'category'])->name('category');
Route::get('the-loai/{slug}', [IndexController::class, 'genre'])->name('genre');
Route::get('/quoc-gia/{slug}', [IndexController::class, 'country'])->name('country');
Route::get('/phim/{slug}', [IndexController::class, 'movie'])->name('movie');
Route::get('/xem-phim/{slug}/{tap}', [IndexController::class, 'watch']);
Route::get('/so-tap', [IndexController::class, 'episode'])->name('so-tap');
Route::get('/year/{year}', [IndexController::class, 'year']);
Route::get('/tag/{tag}', [IndexController::class, 'tag']);
Route::get('/tag/{tag}', [IndexController::class, 'tag']);
Route::get('/tim-kiem', [IndexController::class, 'timkiem'])->name('tim-kiem');
Route::get('/locphim', [IndexController::class, 'locphim'])->name('locphim');
Route::post('/add-rating', [IndexController::class,'add_rating'])->name('add-rating');
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::resource('category', CategoryController::class);
//thong tin web
Route::resource('info', MovieController::class);

Route::post('resorting', [CategoryController::class,'resorting'])->name('resorting');
Route::resource('genre', GenreController::class);
Route::resource('country', CountryController::class);

Route::get('add-episode/{id}', [EpisodeController::class,'add_episode'])->name('add-episode');

Route::resource('episode', EpisodeController::class);
Route::get('select-movie', [EpisodeController::class,'select_movie'])->name('select-movie');

Route::resource('movie', MovieController::class);
Route::get('/update-year-phim', [MovieController::class, 'update_year']);
Route::get('/update-topview-phim', [MovieController::class, 'update_topview']);
Route::get('/filter-topview-phim', [MovieController::class, 'filter-topview']);
Route::get('/filter-topview-default', [MovieController::class, 'filter-default']);
Route::get('/update-season-phim', [MovieController::class, 'update_season']);

//thay doi danh muc

Route::get('/category-choose', [MovieController::class, 'category_choose'])->name('category-choose');

Route::get('/country-choose', [MovieController::class, 'country_choose'])->name('country-choose');
// danh gia phim


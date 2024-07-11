<?php

use App\Http\Controllers\EmailController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/films/ricerca', [HomeController::class, 'search'])->name('films.search');

Route::get('/contact', function () {
    return view('contact');
})->name('email');

Route::post('/send-email', [EmailController::class, 'sendEmail'])->name('sendEmail');

Route::get('admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');


Route::get('/films', [FilmController::class, 'index'])->name('films.index');
Route::get('/films/create', [FilmController::class, 'create'])->name('films.create');
Route::post('/films', [FilmController::class, 'store'])->name('films.store');
Route::get('/films/{id}', [FilmController::class, 'show'])->name('films.show');
Route::get('/films/{id}/edit', [FilmController::class, 'edit'])->name('films.edit');
Route::put('/films/{id}', [FilmController::class, 'update'])->name('films.update');
Route::delete('/films/{id}', [FilmController::class, 'destroy'])->name('films.destroy');

//rotta per creare una nuova recensione
Route::get('/films/{film}/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
//rotta per memorizzare una nuova recensione
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
//rotta per visualizzare tutte le recensioni di un film
Route::get('/films/{film}/reviews', [ReviewController::class, 'index'])->name('reviews.index');
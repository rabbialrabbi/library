<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('/dashboard', function () {
    return view('pages.dashboard.index');
})->middleware(['auth'])->name('dashboard');

Route::resource('/jamaat','App\Http\Controllers\JamaatController');
Route::resource('/member', 'App\Http\Controllers\MemberController');
Route::resource('/book-self', 'App\Http\Controllers\BookSelfController');
Route::resource('/language', 'App\Http\Controllers\LanguageController');
Route::resource('/author', 'App\Http\Controllers\AuthorController');
Route::resource('/subject', 'App\Http\Controllers\SubjectController');
Route::get('/book-title/{bookTitle}', [\App\Http\Controllers\BookController::class,'show'])->name('books.show');
Route::resource('/book', 'App\Http\Controllers\BookController');
Route::get('/set-book', [\App\Http\Controllers\BookController::class,'showSetBook'])->name('set.book.show');
Route::post('/set-book', [\App\Http\Controllers\BookController::class,'storeSetBook'])->name('set.book.store');
//Route::resource('/teacher', 'App\Http\Controllers\MemberController');


require __DIR__.'/auth.php';

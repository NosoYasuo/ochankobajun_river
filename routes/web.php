<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;

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

// Route::get('/', function () {
//     return view('index');
// });

Route::group(['middleware' => ['auth','verified']], function () {

    Route::get('/', [PostController::class, 'index']);
    Route::get('/myriver/{river_id}', [PostController::class, 'myRiver']);
    Route::post('/posts', [PostController::class, 'store']);


    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Route::delete('/book/{book}', function (Book $book) {
    //     //
    // });

});

Auth::routes();

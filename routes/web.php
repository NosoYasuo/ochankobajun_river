<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\NewsController;

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

Route::get('/', [PostController::class, 'index']);

Route::group(['middleware' => ['auth','verified']], function () {


    Route::get('/myriver/{river_id}', [PostController::class, 'myRiver']);
    Route::get('/mypage', [PostController::class, 'myPage']);
    Route::post('/posts', [PostController::class, 'store']);
    Route::post('/comment', [PostController::class, 'comment']);
    Route::get('/info', [PostController::class, 'scrape'])->middleware('checkadmin');
    Route::post('/like', [LikeController::class, 'like']);
    Route::post('myriver/like', [LikeController::class, 'like']);


    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::post('/news/subscription', [NewsController::class, 'subscription'])->name('subscription');

    // Route::delete('/book/{book}', function (Book $book) {
    //     //
    // });

});

Auth::routes();

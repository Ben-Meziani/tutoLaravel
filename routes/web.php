<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('auth.login');
Route::delete('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('auth.logout');
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'doLogin']);

route::prefix('/blog')->name('blog.')->group(function(){
    Route::get('/', [\App\Http\Controllers\BlogController::class, 'index'])->name('index');
    Route::get('/new', [\App\Http\Controllers\BlogController::class, 'create'])->name('create')->middleware('auth');
    Route::post('/new', [\App\Http\Controllers\BlogController::class, 'store'])->name('store');
    Route::get('/{post}/edit', [\App\Http\Controllers\BlogController::class, 'edit'])->name('edit')->middleware('auth');
    Route::post('/{post}/edit', [\App\Http\Controllers\BlogController::class, 'update'])->name('update');
    Route::get('/{slug}-{post}', [\App\Http\Controllers\BlogController::class, 'show'])->where([
        'id' => '[0-9]',
        'slug' => '[a-z0-9\-]+'
    ])->name('show');

});


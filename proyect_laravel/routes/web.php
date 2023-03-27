<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\CategorytController;




Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::resource('/dashboard/category', 'dashboard\categoryController');
Route::resource('/dashboard/user', 'dashboard\UserController');
Route::resource('/dashboard/post', PostController::class);
Route::resource('/dashboard/category', CategorytController::class);


//Route::get('/', 'web\WebController@index')->name('index');
Route::get('/home', 'HomeController@index')->name('home');


//Auth::routes();

require __DIR__.'/auth.php';

Route::resource('/dashboard/category', CategorytController::class);
Route::resource( '/roles', RolController::class);

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::get('/', function () {
    return view('welcome');
});

//Route::get('about', function () {
//    return view('about');
//})->name('about');
Route::get('about', [PageController::class, 'about'])->name('about');

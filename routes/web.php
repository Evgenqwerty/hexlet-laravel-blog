<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ArticleController;

Route::get('/', function () {
    return view('welcome');
});

//Route::get('about', function () {
//    return view('about');
//})->name('about');
Route::get('about', [PageController::class, 'about'])->name('about');

// Название сущности в URL во множественном числе, контроллер в единственном
Route::get('articles', [ArticleController::class, 'index'])
    ->name('articles.index'); // имя маршрута, нужно для того, чтобы не создавать ссылки руками

//Важно добавить этот маршрут до маршрута articles/{id}. Иначе последний перехватит обращение к articles/create, так как он соответствует шаблону.
Route::get('articles/create', [ArticleController::class, 'create'])
    ->name('articles.create');

# id – параметр, который зависит от конкретной статьи
# Фигурные скобки нужны для описания параметров маршрута
Route::get('articles/{id}', [ArticleController::class, 'show'])
    ->name('articles.show');

//обработчик данных формы
Route::post('articles', [ArticleController::class, 'store'])
    ->name('articles.store');

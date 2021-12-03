<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('articles', [ArticleController::class, 'index'] )->name('article.index');
Route::get('/show/article/{id}',[ArticleController::class, 'show'] )->name('article.show');
Route::post('create/article', [ArticleController::class, 'create'] )->name('article.create');
Route::get('destroy/article/{id}', [ArticleController::class, 'destroy'] )->name('article.destroy');
Route::get('edit/article/{id}', [ArticleController::class, 'edit'] )->name('article.edit');
Route::post('update/article/{article}', [ArticleController::class, 'update'] )->name('article.update');
Route::get('query/response/{query}',[ArticleController::class, 'searchQuery'] )->name('search.response');



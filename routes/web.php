<?php

use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;

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


Auth::routes();

Route::middleware(['auth.user'])->group(function () {
    Route::get('/myArticle', [ArticleController::class, 'myArticle'])->name('articles.myArticle');
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
    Route::get('/articles/{id}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::put('/articles/{id}/update', [ArticleController::class, 'update'])->name('articles.update');
    Route::delete('/articles/{id}/destroy', [ArticleController::class, 'destroy'])->name('articles.destroy');
    Route::post('/articles/approve/{article}', [ArticleController::class, 'approve'])->name('articles.approve');
    Route::post('/articles/{article}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}/destroy', [CommentController::class, 'destroy'])->name('comments.destroy');
});

Route::get('/', [ArticleController::class, 'index'])->name('articles.index');
Route::get('admin/articles', [ArticleController::class, 'article'])->name('articles.articles');
Route::get('articles/search', [ArticleController::class, 'search'])->name('articles.search');
Route::get('/articles/{id}/show', [ArticleController::class, 'show'])->name('articles.show');




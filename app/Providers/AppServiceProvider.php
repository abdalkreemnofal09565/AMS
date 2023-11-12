<?php

namespace App\Providers;

use App\Http\Repository\ArticleRepository;
use App\Http\Repository\ArticleRepositoryInterface;
use App\Http\Repository\CommentRepository;
use App\Http\Repository\CommentRepositoryInterface;
use App\Models\Article;
use App\Observers\ArticleObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //

        // In AppServiceProvider.php or another service provider
        $this->app->bind(ArticleRepositoryInterface::class, ArticleRepository::class);
        $this->app->bind(CommentRepositoryInterface::class, CommentRepository::class);

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

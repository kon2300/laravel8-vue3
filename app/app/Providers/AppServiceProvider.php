<?php

namespace App\Providers;

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
        $this->app->bind(
            \App\Repositories\User\UserRepositoryInterface::class,
            \App\Repositories\User\UserRepository::class
        );

        $this->app->bind(
            \App\Repositories\Article\ArticleRepositoryInterface::class,
            \App\Repositories\Article\ArticleRepository::class
        );

        $this->app->bind(
            \App\Repositories\Favorite\FavoriteRepositoryInterface::class,
            \App\Repositories\Favorite\FavoriteRepository::class
        );

        $this->app->bind(
            \App\Repositories\Comment\CommentRepositoryInterface::class,
            \App\Repositories\Comment\CommentRepository::class
        );

        $this->app->bind(
            \App\Repositories\CommentLike\CommentLikeRepositoryInterface::class,
            \App\Repositories\CommentLike\CommentLikeRepository::class
        );

        $this->app->bind(
            \App\Repositories\Follow\FollowRepositoryInterface::class,
            \App\Repositories\Follow\FollowRepository::class
        );
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

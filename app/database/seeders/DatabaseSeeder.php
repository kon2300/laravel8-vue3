<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();
        \App\Models\Tag::factory(10)->create();
        \App\Models\Article::factory(10)->create();
        \App\Models\Comment::factory(10)->create();
        \App\Models\Favorite::factory(10)->create();
        \App\Models\CommentLike::factory(10)->create();
        \App\Models\FollowUser::factory(10)->create();
    }
}

<?php

namespace Database\Seeders;

use App\Http\Controllers\Api\ArticleController;
use App\Models\Article;
use App\Models\Job;
use App\Models\Url;
use App\Models\User;
use Database\Factories\ArticleFactory;
use Database\Factories\JobFactory;
use Database\Factories\UrlFactory;
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

        User::factory()
            ->has(Job::factory()->count(3)->has(
                Url::factory()->count(4)->has(
                    Article::factory()->count(2))))->count(2)->create();


    }
}

<?php

namespace Database\Seeders;

use App\Models\CrawlerJob;
use App\Models\Url;
use Database\Factories\ArticleFactory;
use Database\Factories\JobFactory;
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

        CrawlerJob::factory()
            ->has(Url::factory([
                'url' => 'http://www.google.lt'
            ]))->count(1)->create();

    }
}

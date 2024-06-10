<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\NewsService;
use App\Models\Article;
use Carbon\Carbon;

class FetchArticles extends Command
{
    protected $signature = 'fetch:articles {country=us} {category?}';
    protected $description = 'Fetch articles from the news API and store them in the database';

    protected $newsService;

    public function __construct(NewsService $newsService)
    {
        parent::__construct();
        $this->newsService = $newsService;
    }

    public function handle()
    {
        $country = $this->argument('country');
        $category = $this->argument('category');

        $news = $this->newsService->fetchNews($country, $category);

        if ($news && isset($news['data'])) {
            foreach ($news['data'] as $newsItem) {
                Article::updateOrCreate(
                    ['title' => $newsItem['title']],
                    [
                        'content' => $newsItem['description'],
                        'source' => $newsItem['url'],
                        'category_id' => 1, // Assuming 1 is a valid category ID in your system
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]
                );
            }
        }

        $this->info('Articles have been fetched and stored in the database.');
    }
}

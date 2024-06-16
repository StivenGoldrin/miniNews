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

        try {
            // Fetch news from the external API using the injected NewsService
            $news = $this->newsService->fetchNews($country, $category);

            if ($news && isset($news['data'])) {
                foreach ($news['data'] as $newsItem) {
                    // Update or create the article in the local database
                    Article::updateOrCreate(
                        ['source' => $newsItem['url']], // Assuming 'url' is unique for each article
                        [
                            'title' => $newsItem['title'],
                            'description' => $newsItem['description'],
                            'content' => $newsItem['content'] ?? '', // Adjust based on API response structure
                            'image_url' => $newsItem['image_url'] ?? null, // Optional fields
                            'published_at' => $newsItem['published_at'] ?? null,
                            'category_id' => 1, // Replace with actual category ID in your system
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now()
                        ]
                    );
                }

                $this->info('Articles have been fetched and stored in the database.');
            } else {
                $this->error('No data found in the API response.');
            }
        } catch (\Exception $e) {
            $this->error('Failed to fetch articles: ' . $e->getMessage());
        }
    }
}

<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\Article;

class NewsService
{
    public function fetchNews()
    {
        $apiKey = config('services.newsapi.key');
        $response = Http::get('https://api.thenewsapi.com/v1/news/top', [
            'api_token' => $apiKey,
            'locale' => 'us',
            'language' => 'en'
        ]);

        if ($response->successful()) {
            $newsData = $response->json();

            foreach ($newsData['data'] as $newsItem) {
                Article::updateOrCreate(
                    ['title' => $newsItem['title']],
                    [
                        'content' => $newsItem['description'] ?? 'No content available',
                        'source' => $newsItem['source']['name'] ?? 'Unknown',
                        'category_id' => 1 // Assuming a default category for now
                    ]
                );
            }
        } else {
            // Handle the error appropriately
            //\Log::error('Failed to fetch news', ['response' => $response->body()]);
        }
    }
}

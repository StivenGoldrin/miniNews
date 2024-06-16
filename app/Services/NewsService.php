<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\Article;
use App\Models\Category;
use Carbon\Carbon;

class NewsService
{
    protected $categoryMap;

    public function __construct()
    {
        // Define the category mapping here
        $this->categoryMap = [
            'general' => Category::where('name', 'general')->first()->id,
            'health' => Category::where('name', 'health')->first()->id,
            'tech' => Category::where('name', 'tech')->first()->id,
            'sports' => Category::where('name', 'sports')->first()->id,
            'science' => Category::where('name', 'science')->first()->id,
            'business' => Category::where('name', 'business')->first()->id,
            'entertainment' => Category::where('name', 'entertainment')->first()->id,
            'politics' => Category::where('name', 'politics')->first()->id,
            'food' => Category::where('name', 'food')->first()->id,
            'travel' => Category::where('name', 'travel')->first()->id,
        ];
    }

    public function fetchNews($country, $category = null)
    {
        $apiKey = config('services.newsapi.key');
        $response = Http::get('https://api.thenewsapi.com/v1/news/all', [
            'api_token' => $apiKey,
            'locale' => $country, 
            'language' => 'en', 
            'categories' => $category
        ]);

        if ($response->successful()) {
            $newsData = $response->json();

            foreach ($newsData['data'] as $newsItem) {
                // Check if category key exists
                $categoryId = $this->mapCategory($newsItem['category'] ?? 'general');

                Article::updateOrCreate(
                    ['source' => $newsItem['url']], // Assuming 'url' is unique for each article
                    [
                        'title' => $newsItem['title'],
                        'snippet' => $newsItem['snippet'],
                        'url' => $newsItem['url'],
                        'language' => $newsItem['language'],
                        'description' => $newsItem['description'],
                        'content' => $newsItem['content'] ?? '', // Adjust based on API response structure
                        'image_url' => $newsItem['image_url'] ?? null, // Optional fields
                        'category_id' => $categoryId, // Use the mapped category ID
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]
                );
            }
        } else {
            // Handle the error appropriately
            throw new \Exception('Failed to fetch news: ' . $response->status());
        }
    }

    protected function mapCategory($apiCategory)
    {
        // Use the category map to find the corresponding category ID
        return $this->categoryMap[$apiCategory] ?? Category::where('name', 'general')->first()->id; // Default to 'general' if not found
    }
}

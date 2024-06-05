<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Article;
use App\Models\Preference;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Users
        $user1 = User::create([
            'name' => 'Alice',
            'email' => 'alice@example.com',
            'password' => bcrypt('password')
        ]);

        $user2 = User::create([
            'name' => 'Bob',
            'email' => 'bob@example.com',
            'password' => bcrypt('password')
        ]);

        // Create Preferences
        Preference::create([
            'user_id' => $user1->id,
            'language' => 'English',
            'genre' => 'Technology',
            'region' => 'US'
        ]);

        Preference::create([
            'user_id' => $user2->id,
            'language' => 'French',
            'genre' => 'Sports',
            'region' => 'FR'
        ]);

        // Create Categories
        $category1 = Category::create(['name' => 'Tech']);
        $category2 = Category::create(['name' => 'Sports']);
        $category3 = Category::create(['name' => 'Entertainment']);

        // Create Articles
        $article1 = Article::create([
            'title' => 'New Tech Trends in 2024',
            'content' => 'There are many new tech trends emerging in 2024...',
            'source' => 'TechCrunch',
            'category_id' => $category1->id
        ]);

        $article2 = Article::create([
            'title' => 'Top Sports Events in 2024',
            'content' => 'Here are the top sports events to look forward to in 2024...',
            'source' => 'ESPN',
            'category_id' => $category2->id
        ]);

        $article3 = Article::create([
            'title' => 'Upcoming Movies in 2024',
            'content' => 'The entertainment industry is buzzing with new movie releases...',
            'source' => 'Variety',
            'category_id' => $category3->id
        ]);
    }
}

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
        $categories = [
            'general',
            'health',
            'tech',
            'sports',
            'science',
            'business',
            'politics',
            'food',
            'travel',
            'entertainment',
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(['name' => $category]);
        }

    }
}

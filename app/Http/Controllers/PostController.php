<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Services\NewsService;

class PostController extends Controller
{
    protected $newsService;

    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }

    /**
     * Display a listing of the blog entries.
     */
    public function index(Request $request)
    {
        $category = $request->get('category');
        $country = $request->get('country', 'us'); // Default to 'us' if no country is selected

        // Fetching news from the API
        $news = $this->newsService->fetchNews($country, $category);

        // Fetch articles and categories from the database
        $query = Article::query();

        if ($category) {
            $query->where('category_id', $category);
        }

        $articles = $query->get()->sortByDesc('created_at');
        $categories = Category::all();

        // Combine fetched news with local articles
        $allArticles = collect($news)->merge($articles);

        if ($request->ajax()) {
            return view('articles.partials.articles', compact('allArticles'))->render();
        }

        return view('articles.index', compact('allArticles', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $article = Article::findOrFail($id);
        $categories = Category::all();
        return view('articles.show', compact('article', 'categories'));
    }

    /**
     * Show the form for editing the article.
     */
    public function edit(string $id)
    {
        $article = Article::find($id);
        $categories = Category::all();
        return view('articles.edit', compact('article', 'categories'));
    }

    /**
     * Update the post data in database.
     */
    public function update(Request $request, string $id)
    {
        // Basic validation
        if (!$request->title || !$request->author || !$request->body) {
            return redirect()->route('articles.edit', $id);
        }

        // Updating the post
        $article = Article::find($id);
        $article->title = $request->title;
        $article->author = $request->author;
        $article->body = $request->body;
        $article->category_id = $request->category_id;
        $article->save();

        return redirect()->route('articles.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Article::findOrFail($id)->delete();
        return redirect()->route('articles.index');
    }
}

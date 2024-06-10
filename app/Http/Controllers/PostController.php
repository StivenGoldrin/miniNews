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
    public function index()
    {
        // Fetching news from the API
        $news = $this->newsService->fetchNews('technology');

        // Reads all articles and all categories from the database
        $articles = Article::all()->sortByDesc('created_at');
        $categories = Category::all();

        return view('articles.index', compact('articles', 'categories', 'news'));
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
        $article = Article::find($id);
        return view('articles.show', compact('article'));
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

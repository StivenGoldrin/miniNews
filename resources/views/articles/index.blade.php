<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blog page</title>
</head>
<body>
    <h1>Welcome to the programming blog</h1>
    @foreach ($articles as $article)
        <h2><a href="{{ route('articles.show', $article->id) }}">{{ $article->title }}</a></h2>
        <p>An article by <em>{{ $article->author }}</em> published on {{ $article->created_at->format('d.m.Y H:i:s') }}</p>
        <p>{{ $article->body }}</p>
        <p>
            <form method="POST" action="{{ route('articles.destroy', $article->id) }}">
                @csrf
                @method('DELETE')
                <button type="submit">Delete post</button>
            </form>
        </p>
    @endforeach
</body>
</html>

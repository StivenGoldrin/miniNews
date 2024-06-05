<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $article->title }}</title>
</head>
<body>
    <h1>Show Post</h1>
    <div>
        <h2>{{ $article->title }}</h2>
        <p>{{ $article->content }}</p>
        <p>Author: {{ $article->author }}</p>
        <p>Published at: {{ $article->created_at->format('d.m.Y H:i:s') }}</p>
        <p>Category: {{ $article->category->name }}</p>
    </div>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <title>Articles</title>
</head>
<body>
    <h1>Articles</h1>
    <ul>
        @foreach($articles as $article)
            <li>
                <h2>{{ $article->title }}</h2>
                <p>{{ $article->content }}</p>
                <p><strong>Source:</strong> {{ $article->source }}</p>
                <p><strong>Category ID:</strong> {{ $article->category_id }}</p>
                <p><strong>Published At:</strong> {{ $article->created_at }}</p>
            </li>
        @endforeach
    </ul>
</body>
</html>

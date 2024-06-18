<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $article->title }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .content {
            margin: 0 20px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $article->title }}</h1>
        <p><strong>Published at:</strong> {{ \Carbon\Carbon::parse($article->published_at)->format('d M Y H:i:s') }}</p>
    </div>
    <div class="content">
        @if($article->image_url)
            <img src="{{ $article->image_url }}" alt="{{ $article->title }}" style="width:100%; max-height:400px; object-fit:cover;">
        @endif
        <p><strong>Description:</strong> {{ $article->description }}</p>
        <p><strong>Snippet:</strong> {{ $article->snippet }}</p>
    </div>
    <div class="footer">
        <p><strong>URL:</strong> <a href="{{ $article->url }}">{{ $article->url }}</a></p>
    </div>
</body>
</html>

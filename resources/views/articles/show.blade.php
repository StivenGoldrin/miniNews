<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $article->title }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .navbar {
            margin-bottom: 2rem;
        }
        .card-img-top {
            max-height: 400px;
            object-fit: cover;
        }
        .card-footer {
            font-size: 0.85rem;
        }
        .back-button, .download-button, .delete-button {
            margin-top: 1rem;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="{{ route('articles.index') }}">MiniNews</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    @auth
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link">{{ __('messages.logout') }}</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('messages.login') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('messages.register') }}</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </nav>

        <div class="card mb-4">
            @if($article->image_url)
                <img src="{{ $article->image_url }}" class="card-img-top" alt="{{ $article->title }}">
            @endif
            <div class="card-body">
                <h1 class="card-title">{{ $article->title }}</h1>
                <p class="card-text">{{ $article->content }}</p>
            </div>
            <div class="card-footer text-muted">
                <p><strong>{{ __('messages.description') }}:</strong> {{ $article->description }}</p>
                <p><strong>{{ __('messages.snippet') }}:</strong> {{ $article->snippet }}</p>
                <p><strong>URL:</strong> <a href="{{ $article->url }}" target="_blank">{{ $article->url }}</a></p>
                <p><strong>{{ __('messages.source') }}:</strong> {{ $article->source }}</p>
                <p><strong>{{ __('messages.language') }}:</strong> {{ $article->language }}</p>
                <p><strong>{{ __('messages.published_at') }}:</strong> {{ \Carbon\Carbon::parse($article->published_at)->format('d M Y H:i:s') }}</p>
                <p><strong>{{ __('messages.categories') }}:</strong>
                    @if(!empty($article->categories))
                        @foreach(json_decode($article->categories, true) as $category)
                            <span class="badge badge-secondary">{{ $category }}</span>
                        @endforeach
                    @else
                        <span>No categories</span>
                    @endif
                </p>
            </div>
        </div>

        <a href="{{ route('articles.index') }}" class="btn btn-secondary back-button">{{ __('messages.Back_to_Articles') }}</a>
        @auth
            <a href="{{ route('articles.download', $article->id) }}" class="btn btn-primary download-button">{{ __('messages.Download_as_PDF') }}</a>
            @if(auth()->user()->role_id == 1)
                <form action="{{ route('articles.destroy', $article->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger delete-button" onclick="return confirm('Are you sure you want to delete this article?')">{{ __('messages.Delete_Article') }}</button>
                </form>
            @endif
        @endauth
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $article->title }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">MiniNews</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav mr-auto">
                    @foreach($categories as $category)
                        <li class="nav-item">
                            <a class="nav-link" href="#">{{ $category->name }}</a>
                        </li>
                    @endforeach
                </ul>
                <ul class="navbar-nav ml-auto">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link">Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </nav>

        <div class="card mt-4">
            <div class="card-body">
                <h1 class="card-title">{{ $article->title }}</h1>
                <p class="card-text">{{ $article->content }}</p>
            </div>
            <div class="card-footer text-muted">
                Source: {{ $article->source }}
                <br>
                Published at: {{ $article->created_at->format('d M Y') }}
            </div>
        </div>
        <a href="{{ route('articles.index') }}" class="btn btn-secondary mt-4">Back to Articles</a>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

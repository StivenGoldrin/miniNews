<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Articles</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .navbar {
            margin-bottom: 2rem;
        }
        .card-img-top {
            max-height: 200px;
            object-fit: cover;
        }
        .card-footer {
            font-size: 0.85rem;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">MiniNews</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto">
                    @foreach($categories as $category)
                        <li class="nav-item">
                            <a class="nav-link category-filter" href="#" data-category-id="{{ $category->id }}">{{ $category->name }}</a>
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

        <div class="row mt-4" id="article-container">
            @foreach($allArticles as $article)
                <div class="col-md-4 mb-4 article-card" data-category-id="{{ $article->category_id }}">
                    <div class="card">
                        @if($article->image_url)
                            <img src="{{ $article->image_url }}" class="card-img-top" alt="{{ $article->title }}">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $article->title }}</h5>
                            <p class="card-text">{{ Str::limit($article->description ?? $article->snippet, 100) }}</p>
                            <a href="{{ route('articles.show', $article->id) }}" class="btn btn-primary">Read More</a>
                        </div>
                        <div class="card-footer text-muted">
                            Source: {{ $article->source }}
                            <br>
                            Published at: {{ \Carbon\Carbon::parse($article->published_at)->format('d M Y') }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.category-filter').on('click', function(e) {
                e.preventDefault();
                var categoryId = $(this).data('category-id');

                $.ajax({
                    url: "{{ route('articles.index') }}",
                    method: 'GET',
                    data: { category: categoryId },
                    success: function(response) {
                        $('#article-container').html(response);
                    }
                });
            });
        });
    </script>
</body>
</html>

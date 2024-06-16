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
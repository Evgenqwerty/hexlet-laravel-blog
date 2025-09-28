@extends('layouts.app')

@section('title', 'Articles')

@section('content')
    <h1>Articles</h1>

    @if($articles->count())
        <div class="row">
            @foreach($articles as $article)
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">
                                <!-- Делаем имя статьи ссылкой -->
                                <a href="{{ route('articles.show', $article->id) }}" class="text-decoration-none">
                                    {{ $article->name }}
                                </a>
                            </h5>
                            <p class="card-text">{{ Str::limit($article->body, 100) }}</p>
                            <small class="text-muted">
                                Created: {{ $article->created_at->format('d.m.Y') }} <br><br>
                            </small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Пагинация -->
        <div class="mt-4">
            {{ $articles->links() }}
        </div>
    @else
        <div class="alert alert-info">
            No articles found.
        </div>
    @endif
@endsection

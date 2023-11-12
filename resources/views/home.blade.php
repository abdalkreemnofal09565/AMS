@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <form action="{{ route('articles.search') }}" method="GET">
            <div class="form-group" style="margin: 15px 0px;">
                <div class="input-group">
                    <input type="text" name="query" placeholder="Search articles..." class="form-control" style="margin: 5px;">
                    <div class="input-group-append" style="margin: 5px;">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </div>
        </form>

        @if($articles)
            @foreach($articles as $article)
                <div class="col-md-4">
                    <a href="{{ route('articles.show', ['id' => $article->id]) }}" class="card-link" style="text-decoration: none;">

                        <div class="card mb-4 shadow-sm">
                            @if ($article->image)
                                <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="img-fluid img-style">
                            @else
                                <img src="{{ asset('storage/placeholder-image.jpg') }}" alt="Placeholder Image" class="img-fluid img-style">
                            @endif
                            <div class="card-body">
                                <h4 class="card-title">{{ $article->title }}</h4>
                                <p class="card-text">{{ $article->brief_content }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">By {{ $article->user->name }}</small>
                                    <small class="text-muted">{{ $article->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        @endif

    </div>
</div>
@endsection

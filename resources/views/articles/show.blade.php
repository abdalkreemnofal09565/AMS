@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <small class="text-muted">By {{ $article->user->name }}</small>
                        <small class="text-muted" style="float: right;">{{ $article->created_at->diffForHumans() }}</small>
                        <div style="text-align: center;">
                            <h2 class="card-title">{{ $article->title }}</h2>
                            @if ($article->image)
                                <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="img-fluid">
                            @else
                                <img src="{{ asset('storage/placeholder-image.jpg') }}" alt="Placeholder Image" class="img-fluid">
                            @endif
                        </div>
                        <p class="card-text">{{ $article->content }}</p>
                    </div>
                </div>

                <div class="mt-4">
                    <h3>Comments</h3>
                    <!-- Comment Form -->
                    @if (auth()->check())
                        <form action="{{ route('comments.store', ['article' => $article->id]) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="comment">Add a Comment:</label>
                                <textarea class="form-control" id="comment" name="content" rows="4" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Comment</button>
                        </form>
                    @else
                        <p>You must be logged in to leave a comment.</p>
                    @endif

                    <!-- Display Comments -->
                    <div class="mt-4">
                        @foreach ($article->comments as $comment)
                            <div class="card mb-2">
                                <div class="card-body">
                                    <p class="card-name">{{ $comment->user->name }}</p>
                                    <p class="card-text">{{ $comment->content }}</p>
                                    @if (auth()->check() && auth()->user()->id === $comment->user_id)
                                        <form action="{{ route('comments.destroy', ['comment' => $comment->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete Comment</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

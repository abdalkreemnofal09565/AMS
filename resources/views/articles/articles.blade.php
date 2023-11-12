@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h2>Article Management</h2>

                        <a href="{{ route('articles.create') }}" class="btn btn-primary mb-2">Create New Article</a>

                        <table class="table">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Created At</th>
                                <th>Actions</th>
                                @can('approve.articles')
                                <th>Approval</th> <!-- New column for approval -->
                                @endcan
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($articles as $article)
                                <tr>
                                    <td>{{ $article->title }}</td>
                                    <td>{{ $article->user->name }}</td>
                                    <td>{{ $article->created_at->format('Y-m-d H:i') }}</td>
                                    <td>
                                        <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-warning">Edit</a>
                                        <form method="POST" action="{{ route('articles.destroy', $article->id) }}" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this article?')">Delete</button>
                                        </form>
                                    </td>
                                    @can('approve.articles', $article)
                                    <td>
                                            @if (!$article->is_approved)
                                                <form method="POST" action="{{ route('articles.approve', $article->id) }}" style="display: inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success">Approve</button>
                                                </form>
                                            @else
                                                <span class="text-success">Approved</span>
                                            @endif
                                    </td>
                                    @endcan
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

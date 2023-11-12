@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h2>Edit Article</h2>

                        <form method="POST" action="{{ route('articles.update', $article->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group" style="margin: 10px 0px;">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" class="form-control" value="{{ $article->title }}">
                            </div>

                            <div class="form-group" style="margin: 15px 0px;">
                                <label for="title">Brief Content </label>
                                <input type="text" name="brief_content" id="brief_content" value="{{ $article->brief_content }}" class="form-control" value="{{ old('brief_content') }}">
                            </div>


                            <div class="form-group" style="margin: 10px 0px;">
                                <label for="content">Content</label>
                                <textarea name="content" id="content" class="form-control">{{ $article->content }}</textarea>
                            </div>

                            @if ($article->image)
                                <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="img-fluid" style="width: 200px;height: 200px;">
                            @endif
                            <div class="form-group" style="margin: 10px 0px;">
                                <label for="image">Image</label>
                                <input type="file" name="image" id="image" class="form-control-file">
                            </div>

                            <button type="submit" class="btn btn-primary">Update Article</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

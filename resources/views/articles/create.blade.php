@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h2>Create New Article</h2>

                        <form method="POST" action="{{ route('articles.store') }}" enctype="multipart/form-data">
                            @csrf
                            {{ method_field('POST') }}
                            <div class="form-group" style="margin: 15px 0px;">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
                            </div>

                            <div class="form-group" style="margin: 15px 0px;">
                                <label for="title">Brief Content </label>
                                <input type="text" name="brief_content" id="brief_content" class="form-control" value="{{ old('brief_content') }}">
                            </div>

                            <div class="form-group" style="margin: 15px 0px;">
                                <label for="content">Content</label>
                                <textarea name="content" id="content" class="form-control">{{ old('content') }}</textarea>
                            </div>

                            <div class="form-group" style="margin: 15px 0px;">
                                <label for="image">Image</label>
                                <input type="file" name="image" id="image" class="form-control-file">
                            </div>

                            <button type="submit" class="btn btn-primary">Create Article</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

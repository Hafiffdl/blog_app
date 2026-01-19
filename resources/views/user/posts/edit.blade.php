@extends('user.layout')

@section('title', 'Edit Post')
@section('page-title', 'Edit Post')
@section('page-description', 'Update your article')

@section('breadcrumb')
    <li><a href="{{ route('user.posts.index') }}">My Posts</a></li>
    <li class="active">Edit</li>
@endsection

@section('content')
    <div class="box box-warning">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Post</h3>
        </div>
        
        <form method="POST" action="{{ route('user.posts.update', $post) }}">
            @csrf
            @method('PUT')
            
            <div class="box-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" 
                           value="{{ old('title', $post->title) }}" required>
                </div>

                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea class="form-control" id="content" name="content" 
                              rows="15" required>{{ old('content', $post->content) }}</textarea>
                </div>

                <div class="callout callout-warning">
                    <h4><i class="fa fa-warning"></i> Warning!</h4>
                    After editing, your post will be submitted for admin approval again.
                </div>
            </div>

            <div class="box-footer">
                <a href="{{ route('user.posts.index') }}" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-warning pull-right">
                    <i class="fa fa-save"></i> Update Post
                </button>
            </div>
        </form>
    </div>
@endsection

@extends('user.layout')

@section('title', 'Create New Post')
@section('page-title', 'Create New Post')
@section('page-description', 'Write a new article')

@section('breadcrumb')
    <li><a href="{{ route('user.posts.index') }}">My Posts</a></li>
    <li class="active">Create</li>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Create New Post</h3>
        </div>
        
        <form method="POST" action="{{ route('user.posts.store') }}">
            @csrf
            
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
                           value="{{ old('title') }}" placeholder="Enter post title" required>
                </div>

                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea class="form-control" id="content" name="content" 
                              rows="15" placeholder="Write your content here..." required>{{ old('content') }}</textarea>
                </div>

                <div class="callout callout-info">
                    <h4><i class="fa fa-info"></i> Note:</h4>
                    Your post will be submitted for admin approval before being published.
                </div>
            </div>

            <div class="box-footer">
                <a href="{{ route('user.posts.index') }}" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-success pull-right">
                    <i class="fa fa-check"></i> Submit for Approval
                </button>
            </div>
        </form>
    </div>
@endsection

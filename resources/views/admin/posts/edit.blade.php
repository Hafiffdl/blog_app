@extends('admin.layout')

@section('title', 'Edit Post')
@section('page-header', 'Edit Post')

@section('breadcrumb')
    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li><a href="{{ route('admin.posts.index') }}">Posts</a></li>
    <li class="active">Edit</li>
@endsection

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Post</h3>
        </div>
        
        <form method="POST" action="{{ route('admin.posts.update', $post) }}">
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
                    <textarea class="form-control" id="content" name="content" rows="10" required>{{ old('content', $post->content) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="pending" {{ old('status', $post->status) === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ old('status', $post->status) === 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ old('status', $post->status) === 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                </div>
            </div>

            <div class="box-footer">
                <a href="{{ route('admin.posts.index') }}" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Post</button>
            </div>
        </form>
    </div>
@endsection

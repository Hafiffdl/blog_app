@extends('admin.layout')

@section('title', 'View Post')
@section('page-header', 'View Post')

@section('breadcrumb')
    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li><a href="{{ route('admin.posts.index') }}">Posts</a></li>
    <li class="active">View</li>
@endsection

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $post->title }}</h3>
        </div>
        <div class="box-body">
            <dl class="dl-horizontal">
                <dt>Author:</dt>
                <dd>{{ $post->user->name }}</dd>
                
                <dt>Status:</dt>
                <dd>
                    @if($post->status === 'pending')
                        <span class="label label-warning">Pending</span>
                    @elseif($post->status === 'approved')
                        <span class="label label-success">Approved</span>
                    @else
                        <span class="label label-danger">Rejected</span>
                    @endif
                </dd>
                
                <dt>Created:</dt>
                <dd>{{ $post->created_at->format('F d, Y h:i A') }}</dd>
                
                <dt>Updated:</dt>
                <dd>{{ $post->updated_at->format('F d, Y h:i A') }}</dd>
            </dl>
            
            <hr>
            
            <h4>Content:</h4>
            <div style="white-space: pre-wrap;">{{ $post->content }}</div>
        </div>
        <div class="box-footer">
            <a href="{{ route('admin.posts.index') }}" class="btn btn-default">Back to List</a>
            <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-primary">Edit</a>
            
            @if($post->status === 'pending')
                <form method="POST" action="{{ route('admin.posts.approve', $post) }}" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-check"></i> Approve
                    </button>
                </form>
                <form method="POST" action="{{ route('admin.posts.reject', $post) }}" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-warning">
                        <i class="fa fa-times"></i> Reject
                    </button>
                </form>
            @endif
            
            <form method="POST" action="{{ route('admin.posts.destroy', $post) }}" 
                  style="display:inline;" 
                  onsubmit="return confirm('Are you sure you want to delete this post?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="fa fa-trash"></i> Delete
                </button>
            </form>
        </div>
    </div>
@endsection

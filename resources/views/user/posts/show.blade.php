@extends('user.layout')

@section('title', 'View Post')
@section('page-title', 'View Post')
@section('page-description', 'Post details')

@section('breadcrumb')
    <li><a href="{{ route('user.posts.index') }}">My Posts</a></li>
    <li class="active">View</li>
@endsection

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $post->title }}</h3>
            <div class="box-tools pull-right">
                @if($post->status === 'pending')
                    <span class="label label-warning">Pending Approval</span>
                @elseif($post->status === 'approved')
                    <span class="label label-success">Approved</span>
                @else
                    <span class="label label-danger">Rejected</span>
                @endif
            </div>
        </div>
        <div class="box-body">
            <dl class="dl-horizontal">
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
            <a href="{{ route('user.posts.index') }}" class="btn btn-default">
                <i class="fa fa-arrow-left"></i> Back to List
            </a>
            <a href="{{ route('user.posts.edit', $post) }}" class="btn btn-warning">
                <i class="fa fa-edit"></i> Edit
            </a>
            
            @if($post->status === 'approved')
                <a href="{{ route('posts.show', $post) }}" class="btn btn-info" target="_blank">
                    <i class="fa fa-external-link"></i> View Public Page
                </a>
            @endif
            
            <form method="POST" action="{{ route('user.posts.destroy', $post) }}" 
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

@extends('user.layout')

@section('title', 'My Posts')
@section('page-title', 'My Posts')
@section('page-description', 'Manage your articles')

@section('breadcrumb')
    <li class="active">My Posts</li>
@endsection

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">All My Posts</h3>
            <div class="box-tools pull-right">
                <a href="{{ route('user.posts.create') }}" class="btn btn-success btn-sm">
                    <i class="fa fa-plus"></i> Create New Post
                </a>
            </div>
        </div>
        <div class="box-body">
            @if($posts->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $post)
                                <tr>
                                    <td>{{ Str::limit($post->title, 50) }}</td>
                                    <td>
                                        @if($post->status === 'pending')
                                            <span class="label label-warning">Pending</span>
                                        @elseif($post->status === 'approved')
                                            <span class="label label-success">Approved</span>
                                        @else
                                            <span class="label label-danger">Rejected</span>
                                        @endif
                                    </td>
                                    <td>{{ $post->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <a href="{{ route('user.posts.show', $post) }}" 
                                           class="btn btn-xs btn-info">
                                            <i class="fa fa-eye"></i> View
                                        </a>
                                        <a href="{{ route('user.posts.edit', $post) }}" 
                                           class="btn btn-xs btn-warning">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>
                                        <form method="POST" action="{{ route('user.posts.destroy', $post) }}" 
                                              style="display:inline;" 
                                              onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-xs btn-danger">
                                                <i class="fa fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="text-center">
                    {{ $posts->links() }}
                </div>
            @else
                <div class="alert alert-info">
                    You haven't created any posts yet. 
                    <a href="{{ route('user.posts.create') }}">Create your first post!</a>
                </div>
            @endif
        </div>
    </div>
@endsection

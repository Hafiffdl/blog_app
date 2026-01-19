@extends('admin.layout')

@section('title', 'Manage Posts')
@section('page-header', 'Manage Posts')

@section('breadcrumb')
    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="active">Posts</li>
@endsection

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">All Posts</h3>
        </div>
        <div class="box-body">
            @if($posts->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $post)
                                <tr>
                                    <td>{{ $posts->firstItem() + $loop->index }}</td>
                                    <td>{{ Str::limit($post->title, 50) }}</td>
                                    <td>{{ $post->user->name }}</td>
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
                                        <a href="{{ route('admin.posts.show', $post) }}" 
                                           class="btn btn-info btn-xs">
                                            <i class="fa fa-eye"></i> View
                                        </a>
                                        <a href="{{ route('admin.posts.edit', $post) }}" 
                                           class="btn btn-primary btn-xs">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>
                                        @if($post->status === 'pending')
                                            <form method="POST" action="{{ route('admin.posts.approve', $post) }}" 
                                                  style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-xs">
                                                    <i class="fa fa-check"></i> Approve
                                                </button>
                                            </form>
                                            <form method="POST" action="{{ route('admin.posts.reject', $post) }}" 
                                                  style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-warning btn-xs">
                                                    <i class="fa fa-times"></i> Reject
                                                </button>
                                            </form>
                                        @endif
                                        <form method="POST" action="{{ route('admin.posts.destroy', $post) }}" 
                                              style="display:inline;" 
                                              onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-xs">
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
                    No posts found.
                </div>
            @endif
        </div>
    </div>
@endsection

@extends('user.layout')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-description', 'User control panel')

@section('breadcrumb')
    <li class="active">Dashboard</li>
@endsection

@section('content')
    <!-- Info boxes -->
    <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-newspaper-o"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Posts</span>
                    <span class="info-box-number">{{ $totalPosts }}</span>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-clock-o"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Pending Posts</span>
                    <span class="info-box-number">{{ $pendingPosts }}</span>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-check"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Approved Posts</span>
                    <span class="info-box-number">{{ $approvedPosts }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Quick Actions</h3>
                </div>
                <div class="box-body">
                    <a href="{{ route('user.posts.create') }}" class="btn btn-success">
                        <i class="fa fa-plus"></i> Create New Post
                    </a>
                    <a href="{{ route('user.posts.index') }}" class="btn btn-primary">
                        <i class="fa fa-list"></i> Manage My Posts
                    </a>
                    <a href="{{ route('home') }}" class="btn btn-info" target="_blank">
                        <i class="fa fa-eye"></i> View Public Site
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Posts -->
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">My Recent Posts</h3>
                    <div class="box-tools pull-right">
                        <a href="{{ route('user.posts.index') }}" class="btn btn-sm btn-primary">
                            <i class="fa fa-eye"></i> View All
                        </a>
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse(auth()->user()->posts()->latest()->take(5)->get() as $post)
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
                                            <a href="{{ route('user.posts.show', $post) }}" class="btn btn-xs btn-info">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="{{ route('user.posts.edit', $post) }}" class="btn btn-xs btn-warning">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">
                                            No posts found. <a href="{{ route('user.posts.create') }}">Create your first post!</a>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

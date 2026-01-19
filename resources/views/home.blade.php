<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #1e40af;
            --dark-color: #1e293b;
            --light-color: #f8fafc;
            --border-color: #e2e8f0;
        }

        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: var(--light-color);
            color: var(--dark-color);
        }

        .navbar {
            background: white;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            padding: 1rem 0;
        }

        .navbar-brand {
            font-weight: 900;
            font-size: 1.5rem;
            color: var(--primary-color) !important;
        }

        .nav-link {
            font-weight: 500;
            color: var(--dark-color) !important;
            margin: 0 0.5rem;
            transition: color 0.3s;
        }

        .nav-link:hover {
            color: var(--primary-color) !important;
        }

        .btn-primary {
            background: var(--primary-color);
            border: none;
            padding: 0.5rem 1.5rem;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }

        .btn-outline-primary {
            color: var(--primary-color);
            border: 2px solid var(--primary-color);
            padding: 0.5rem 1.5rem;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .btn-outline-primary:hover {
            background: var(--primary-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }

        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 5rem 0;
            margin-bottom: 3rem;
        }

        .hero-section h1 {
            font-weight: 900;
            font-size: 3.5rem;
            margin-bottom: 1rem;
        }

        .hero-section p {
            font-size: 1.25rem;
            opacity: 0.9;
        }

        .blog-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.3s;
            border: 1px solid var(--border-color);
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .blog-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.1);
        }

        .blog-card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 3rem;
        }

        .blog-card-body {
            padding: 1.5rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .blog-card-title {
            font-weight: 700;
            font-size: 1.25rem;
            margin-bottom: 0.75rem;
            color: var(--dark-color);
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .blog-card-excerpt {
            color: #64748b;
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 1rem;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            flex: 1;
        }

        .blog-card-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 1rem;
            border-top: 1px solid var(--border-color);
            font-size: 0.85rem;
            color: #94a3b8;
        }

        .blog-card-author {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .author-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
        }

        .empty-state i {
            font-size: 4rem;
            color: #cbd5e1;
            margin-bottom: 1rem;
        }

        .empty-state h3 {
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        }

        .empty-state p {
            color: #64748b;
        }

        .pagination {
            margin-top: 3rem;
        }

        .page-link {
            color: var(--primary-color);
            border: 1px solid var(--border-color);
            padding: 0.5rem 1rem;
            margin: 0 0.25rem;
            border-radius: 8px;
            font-weight: 500;
        }

        .page-link:hover {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        .page-item.active .page-link {
            background: var(--primary-color);
            border-color: var(--primary-color);
        }

        .footer {
            background: white;
            border-top: 1px solid var(--border-color);
            padding: 2rem 0;
            margin-top: 4rem;
        }

        @media (max-width: 768px) {
            .hero-section h1 {
                font-size: 2.5rem;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-blog"></i> BlogApp
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                    <i class="fas fa-tachometer-alt"></i> Dashboard
                                </a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.dashboard') }}">
                                    <i class="fas fa-tachometer-alt"></i> Dashboard
                                </a>
                            </li>
                        @endif
                        <li class="nav-item ms-2">
                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item ms-2">
                            <a class="btn btn-primary btn-sm" href="{{ route('register') }}">
                                Get Started
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <section class="hero-section">
        <div class="container text-center">
            <h1>Welcome to BlogApp</h1>
            <p class="lead">Discover amazing stories and share your thoughts with the world</p>
            @guest
                <div class="mt-4">
                    <a href="{{ route('register') }}" class="btn btn-light btn-lg me-2">
                        <i class="fas fa-rocket"></i> Start Writing
                    </a>
                    <a href="#posts" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-book-open"></i> Explore Posts
                    </a>
                </div>
            @endguest
        </div>
    </section>

    <div class="container" id="posts">
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="fw-bold">Latest Posts</h2>
                <p class="text-muted">Read the most recent approved posts from our community</p>
            </div>
        </div>

        @if($posts->count() > 0)
            <div class="row g-4">
                @foreach($posts as $post)
                    <div class="col-lg-4 col-md-6">
                        <article class="blog-card">
                            <div class="blog-card-header">
                                <i class="fas fa-newspaper"></i>
                            </div>
                            <div class="blog-card-body">
                                <h3 class="blog-card-title">{{ $post->title }}</h3>
                                <p class="blog-card-excerpt">{{ Str::limit($post->content, 150) }}</p>
                                <div class="blog-card-meta">
                                    <div class="blog-card-author">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($post->user->name) }}&background=667eea&color=fff" 
                                             alt="{{ $post->user->name }}" class="author-avatar">
                                        <span>{{ $post->user->name }}</span>
                                    </div>
                                    <span>
                                        <i class="far fa-calendar"></i> {{ $post->created_at->format('M d, Y') }}
                                    </span>
                                </div>
                                <a href="{{ route('posts.show', $post) }}" class="btn btn-primary w-100 mt-3">
                                    Read More <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-center">
                {{ $posts->links() }}
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-inbox"></i>
                <h3>No Posts Yet</h3>
                <p>Be the first to create a post!</p>
                @auth
                    @if(auth()->user()->role === 'user')
                        <a href="{{ route('user.posts.create') }}" class="btn btn-primary mt-3">
                            <i class="fas fa-plus"></i> Create Your First Post
                        </a>
                    @endif
                @else
                    <a href="{{ route('register') }}" class="btn btn-primary mt-3">
                        <i class="fas fa-user-plus"></i> Register to Start Writing
                    </a>
                @endauth
            </div>
        @endif
    </div>

    <footer class="footer">
        <div class="container text-center">
            <p class="mb-0 text-muted">&copy; {{ date('Y') }} BlogApp. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }} - Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: #f8fafc;
        }

        .navbar {
            background: white;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            font-weight: 900;
            color: #2563eb !important;
        }

        .article-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 4rem 0 3rem;
            margin-bottom: 3rem;
        }

        .article-title {
            font-size: 3rem;
            font-weight: 900;
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }

        .article-meta {
            display: flex;
            align-items: center;
            gap: 2rem;
            font-size: 1rem;
            opacity: 0.9;
        }

        .author-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .author-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            border: 3px solid white;
        }

        .article-content {
            background: white;
            border-radius: 16px;
            padding: 3rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            font-size: 1.125rem;
            line-height: 1.8;
            color: #334155;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: white;
            text-decoration: none;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            background: rgba(255,255,255,0.2);
            border-radius: 8px;
            transition: all 0.3s;
        }

        .back-button:hover {
            background: rgba(255,255,255,0.3);
            color: white;
            transform: translateX(-4px);
        }

        @media (max-width: 768px) {
            .article-title {
                font-size: 2rem;
            }
            
            .article-content {
                padding: 2rem 1.5rem;
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
        </div>
    </nav>

    <header class="article-header">
        <div class="container">
            <a href="{{ route('home') }}" class="back-button mb-4">
                <i class="fas fa-arrow-left"></i> Back to Home
            </a>
            <h1 class="article-title">{{ $post->title }}</h1>
            <div class="article-meta">
                <div class="author-info">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($post->user->name) }}&background=fff&color=667eea&size=96" 
                         alt="{{ $post->user->name }}" class="author-avatar">
                    <div>
                        <div class="fw-bold">{{ $post->user->name }}</div>
                        <div class="small">Author</div>
                    </div>
                </div>
                <div>
                    <i class="far fa-calendar"></i> {{ $post->created_at->format('M d, Y') }}
                </div>
                <div>
                    <i class="far fa-clock"></i> {{ ceil(str_word_count($post->content) / 200) }} min read
                </div>
            </div>
        </div>
    </header>

    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <article class="article-content">
                    {!! nl2br(e($post->content)) !!}
                </article>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\MstKi;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')
            ->approved()
            ->latest()
            ->paginate(10);
            
        return view('home', compact('posts'));
    }

    public function show(Post $post)
    {
        // Only show approved posts
        if ($post->status !== 'approved') {
            abort(404);
        }
        
        return view('post-detail', compact('post'));
    }

    public function kekayaanIntelektual()
    {
        $jenisKi = MstKi::all();
        return view('ki.index', compact('jenisKi'));
    }
}

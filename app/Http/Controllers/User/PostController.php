<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Auth::user()->posts()->latest()->paginate(10);
        return view('user.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('user.posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
        ]);

        Auth::user()->posts()->create([
            'title' => $request->title,
            'content' => $request->content,
            'status' => 'pending', // Default status
        ]);

        return redirect()->route('user.posts.index')
            ->with('success', 'Post created successfully and waiting for approval');
    }

    public function show(Post $post)
    {
        // Check if user owns this post
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }
        
        return view('user.posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        // Check if user owns this post
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }
        
        return view('user.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        // Check if user owns this post
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }
        
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
        ]);

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'status' => 'pending', // Reset to pending after edit
        ]);

        return redirect()->route('user.posts.index')
            ->with('success', 'Post updated and waiting for approval');
    }

    public function destroy(Post $post)
    {
        // Check if user owns this post
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }
        
        $post->delete();
        
        return redirect()->route('user.posts.index')
            ->with('success', 'Post deleted successfully');
    }
}

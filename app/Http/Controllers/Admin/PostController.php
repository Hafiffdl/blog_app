<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->latest()->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $post->update($request->only(['title', 'content', 'status']));

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post updated successfully');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')
            ->with('success', 'Post deleted successfully');
    }

    public function approve(Post $post)
    {
        $post->update(['status' => 'approved']);
        return back()->with('success', 'Post approved successfully');
    }

    public function reject(Post $post)
    {
        $post->update(['status' => 'rejected']);
        return back()->with('success', 'Post rejected');
    }
}

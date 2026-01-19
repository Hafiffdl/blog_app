<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPosts = Post::count();
        $pendingPosts = Post::pending()->count();
        $approvedPosts = Post::approved()->count();
        $totalUsers = User::where('role', 'user')->count();
        $recentPosts = Post::with('user')->latest()->take(5)->get();
        
        return view('admin.dashboard', compact('totalPosts', 'pendingPosts', 'approvedPosts', 'totalUsers', 'recentPosts'));
    }
}

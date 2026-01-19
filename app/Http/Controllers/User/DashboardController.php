<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $totalPosts = $user->posts()->count();
        $pendingPosts = $user->posts()->pending()->count();
        $approvedPosts = $user->posts()->approved()->count();
        
        return view('user.dashboard', compact('totalPosts', 'pendingPosts', 'approvedPosts'));
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin User
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create Regular User
        $user = User::create([
            'name' => 'John Doe',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        // Create some sample posts
        Post::create([
            'user_id' => $user->id,
            'title' => 'Welcome to My Blog',
            'content' => "This is my first blog post. I'm excited to share my thoughts and experiences with you all.\n\nBlogging has been a dream of mine for a long time, and I'm finally making it happen!",
            'status' => 'approved',
        ]);

        Post::create([
            'user_id' => $user->id,
            'title' => 'Getting Started with Laravel',
            'content' => "Laravel is an amazing PHP framework that makes web development a breeze. In this post, I'll share some tips for beginners.\n\n1. Start with the documentation\n2. Practice building small projects\n3. Join the Laravel community\n\nHappy coding!",
            'status' => 'approved',
        ]);

        Post::create([
            'user_id' => $user->id,
            'title' => 'Pending Post - Awaiting Approval',
            'content' => 'This post is still pending approval from the admin. Once approved, it will be visible to everyone.',
            'status' => 'pending',
        ]);

        echo "Admin and user accounts created successfully!\n";
        echo "Admin: admin@example.com / password\n";
        echo "User: user@example.com / password\n";
    }
}

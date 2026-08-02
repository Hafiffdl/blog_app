@extends('layouts.auth')

@section('title', 'Daftar - BlogApp')

@section('content')
    <h2 class="text-2xl font-bold text-slate-900">Buat akun baru</h2>
    <p class="mt-1 text-sm text-slate-500">Mulai berbagi cerita dan ide kamu bersama kami.</p>

    @if($errors->any())
        <div class="mt-4 flex items-start gap-3 rounded-lg border border-rose-200 bg-rose-50 p-4 text-sm text-rose-800">
            <i class="bi bi-exclamation-circle-fill mt-0.5 text-rose-500"></i>
            <div class="flex-1">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}" class="mt-6 space-y-5">
        @csrf
        <div>
            <label for="name" class="form-label">Nama Lengkap</label>
            <div class="input-icon">
                <i class="bi bi-person"></i>
                <input type="text" class="form-control" id="name" name="name"
                       value="{{ old('name') }}" placeholder="Nama kamu" required autofocus>
            </div>
        </div>

        <div>
            <label for="email" class="form-label">Email</label>
            <div class="input-icon">
                <i class="bi bi-envelope"></i>
                <input type="email" class="form-control" id="email" name="email"
                       value="{{ old('email') }}" placeholder="nama@contoh.com" required>
            </div>
        </div>

        <div>
            <label for="password" class="form-label">Kata Sandi</label>
            <div class="input-icon">
                <i class="bi bi-lock"></i>
                <input type="password" class="form-control" id="password"
                       name="password" placeholder="Minimal 8 karakter" required>
            </div>
        </div>

        <div>
            <label for="password_confirmation" class="form-label">Ulangi Kata Sandi</label>
            <div class="input-icon">
                <i class="bi bi-lock-fill"></i>
                <input type="password" class="form-control" id="password_confirmation"
                       name="password_confirmation" placeholder="Ulangi kata sandi" required>
            </div>
        </div>

        <button type="submit" class="btn-primary w-full py-2.5">
            <i class="bi bi-person-plus"></i> Daftar
        </button>
    </form>

    <p class="mt-6 text-center text-sm text-slate-500">
        Sudah punya akun?
        <a href="{{ route('login') }}" class="font-semibold text-primary-600 hover:text-primary-700">Masuk di sini</a>
    </p>
@endsection

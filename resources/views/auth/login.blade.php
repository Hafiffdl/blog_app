@extends('layouts.auth')

@section('title', 'Masuk - BlogApp')

@section('content')
    <h2 class="text-2xl font-bold text-slate-900">Selamat datang kembali</h2>
    <p class="mt-1 text-sm text-slate-500">Masuk untuk melanjutkan ke akun kamu.</p>

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

    <form method="POST" action="{{ route('login') }}" class="mt-6 space-y-5">
        @csrf
        <div>
            <label for="email" class="form-label">Email</label>
            <div class="input-icon">
                <i class="bi bi-envelope"></i>
                <input type="email" class="form-control @error('email') border-rose-400 @enderror" id="email" name="email"
                       value="{{ old('email') }}" placeholder="nama@contoh.com" required autofocus>
            </div>
        </div>

        <div>
            <label for="password" class="form-label">Kata Sandi</label>
            <div class="input-icon">
                <i class="bi bi-lock"></i>
                <input type="password" class="form-control @error('password') border-rose-400 @enderror" id="password"
                       name="password" placeholder="••••••••" required>
            </div>
        </div>

        <div class="flex items-center justify-between">
            <label class="flex cursor-pointer items-center gap-2 text-sm text-slate-600">
                <input type="checkbox" name="remember" id="remember" class="h-4 w-4 rounded border-slate-300 text-primary-600 focus:ring-primary-500">
                Ingat saya
            </label>
        </div>

        <button type="submit" class="btn-primary w-full py-2.5">
            <i class="bi bi-box-arrow-in-right"></i> Masuk
        </button>
    </form>

    <p class="mt-6 text-center text-sm text-slate-500">
        Belum punya akun?
        <a href="{{ route('register') }}" class="font-semibold text-primary-600 hover:text-primary-700">Daftar di sini</a>
    </p>
@endsection

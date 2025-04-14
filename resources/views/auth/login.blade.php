@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-xl font-semibold mb-4">Login</h2>

        <form method="POST" action="{{ route('login.submit') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block mb-1 font-medium">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus
                    class="w-full border px-3 py-2 rounded">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block mb-1 font-medium">Password</label>
                <input type="password" name="password" required class="w-full border px-3 py-2 rounded">
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="text-right">
                <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                    Login
                </button>
            </div>
        </form>
    </div>
@endsection

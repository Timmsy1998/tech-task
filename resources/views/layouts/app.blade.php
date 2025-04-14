<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name', 'User Manager') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-50 text-gray-900 font-sans leading-normal tracking-tight min-h-screen">

    <header class="bg-white shadow">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold text-blue-700">
                <a href="{{ route('users.index') }}">User Manager</a>
            </h1>
            <nav class="space-x-4 text-sm font-medium">
                <a href="{{ route('users.index') }}" class="text-gray-700 hover:text-blue-600 transition">All Users</a>
                @can('create', App\Domain\User\Models\User::class)
                    <a href="{{ route('users.create') }}" class="text-green-700 hover:text-green-500 transition">Add
                        User</a>
                @endcan

                @auth
                    <span class="text-gray-500">Hi, {{ Auth::user()->name }}</span>

                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button class="text-red-600 hover:text-red-400 transition">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-400 transition">Login</a>
                @endauth
            </nav>
        </div>
    </header>

    <main class="container mx-auto px-4 py-8">
        @if (session('success'))
            <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded shadow-sm mb-6">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="bg-white border-t mt-12 py-4 text-center text-sm text-gray-500">
        &copy; {{ date('Y') }} User Manager. All rights reserved.
    </footer>

</body>

</html>

@extends('layouts.app')

@section('content')
    <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-semibold mb-4">{{ $user->name }} {{ $user->surname }}</h2>

        <ul class="space-y-2 text-gray-700">
            <li><strong>Email:</strong> {{ $user->email }}</li>
            <li><strong>Phone:</strong> {{ $user->phone }}</li>
            <li><strong>Country:</strong> {{ config('countries.list')[$user->country] ?? $user->country }}</li>
            <li><strong>Gender:</strong> {{ ucfirst($user->gender) }}</li>
        </ul>

        @if ($user->profile_picture)
            <img src="{{ Storage::url($user->profile_picture) }}" class="h-32 mt-4 rounded border">
        @endif
    </div>
@endsection

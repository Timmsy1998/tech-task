@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-semibold mb-4">Users</h2>

        @forelse ($users as $user)
            @if ($loop->first)
                <table class="min-w-full border divide-y divide-gray-200 mb-6">
                    <thead class="bg-gray-100 text-left text-sm uppercase tracking-wide text-gray-700">
                        <tr>
                            <th class="px-4 py-2">Name</th>
                            <th class="px-4 py-2">Email</th>
                            <th class="px-4 py-2">Country</th>
                            <th class="px-4 py-2 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-gray-800 divide-y divide-gray-100">
            @endif

            <tr>
                <td class="px-4 py-2">{{ $user->name }} {{ $user->surname }}</td>
                <td class="px-4 py-2">{{ $user->email }}</td>
                <td class="px-4 py-2">{{ config('countries.list')[$user->country] ?? $user->country }}</td>
                <td class="px-4 py-2 text-right space-x-2">
                    <a href="{{ route('users.show', $user) }}" class="text-blue-600 hover:underline">View</a>
                    @can('update', $user)
                        <a href="{{ route('users.edit', $user) }}" class="text-yellow-600 hover:underline">Edit</a>
                    @endcan

                    @can('delete', $user)
                        <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline"
                            onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:underline">Delete</button>
                        </form>
                    @endcan

                </td>
            </tr>

            @if ($loop->last)
                </tbody>
                </table>
            @endif
        @empty
            <div class="text-center text-gray-500">
                No users found.
            </div>
        @endforelse

        <div class="mt-6">
            {{ $users->links() }}
        </div>
    </div>
@endsection

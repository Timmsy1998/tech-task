@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-semibold mb-6">
            {{ isset($user) ? 'Edit User' : 'Create User' }}
        </h2>

        <form action="{{ isset($user) ? route('users.update', $user) : route('users.store') }}" method="POST"
            enctype="multipart/form-data" class="space-y-6">
            @csrf
            @if (isset($user))
                @method('PUT')
            @endif

            @include('users._form')

            <div class="text-right">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                    {{ isset($user) ? 'Update' : 'Create' }}
                </button>
            </div>
        </form>
    </div>
@endsection

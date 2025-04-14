@php
    $countries = config('countries.list');
@endphp

@foreach ([
        'name' => 'Name',
        'surname' => 'Surname',
        'email' => 'Email',
        'phone' => 'Phone',
    ] as $field => $label)
    <div>
        <label class="block font-medium mb-1">{{ $label }}</label>
        <input name="{{ $field }}" value="{{ old($field, $user->$field ?? '') }}"
            class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-blue-500 focus:border-blue-500"
            {{ $field === 'email' ? 'type=email' : '' }}>
        @error($field)
            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
        @enderror
    </div>
@endforeach

<div>
    <label class="block font-medium mb-1">Country</label>
    <select name="country" class="w-full border border-gray-300 rounded px-3 py-2 focus:ring focus:ring-blue-200">
        @foreach ($countries as $code => $name)
            <option value="{{ $code }}" {{ old('country', $user->country ?? '') === $code ? 'selected' : '' }}>
                {{ $name }}
            </option>
        @endforeach
    </select>
    @error('country')
        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
    @enderror
</div>

<div>
    <label class="block font-medium mb-1">Gender</label>
    <select name="gender" class="w-full border border-gray-300 rounded px-3 py-2 focus:ring">
        @foreach (['male', 'female', 'other'] as $gender)
            <option value="{{ $gender }}" {{ old('gender', $user->gender ?? '') === $gender ? 'selected' : '' }}>
                {{ ucfirst($gender) }}
            </option>
        @endforeach
    </select>
</div>

<div class="grid grid-cols-2 gap-4">
    <div>
        <label class="block font-medium mb-1">Password</label>
        <input type="password" name="password" class="w-full border rounded px-3 py-2"
            {{ isset($user) ? '' : 'required' }}>
        @error('password')
            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label class="block font-medium mb-1">Confirm Password</label>
        <input type="password" name="password_confirmation" class="w-full border rounded px-3 py-2"
            {{ isset($user) ? '' : 'required' }}>
    </div>
</div>

<div>
    <label class="block font-medium mb-1">Profile Picture</label>
    <input type="file" name="profile_picture" class="w-full">
    @if (!empty($user->profile_picture))
        <img src="{{ Storage::url($user->profile_picture) }}" class="h-20 mt-2 rounded border">
    @endif
</div>

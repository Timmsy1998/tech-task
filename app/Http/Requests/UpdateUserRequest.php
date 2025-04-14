<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Domain\User\Models\User;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        $authUser = $this->user();
        $targetUser = $this->route('user');

        return $authUser->is_admin || $authUser->id === $targetUser->id;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($this->route('user')->id),
            ],
            'phone' => 'nullable|string|max:20',
            'country' => 'required|string|in:' . implode(',', array_keys(config('countries.list'))),
            'gender' => 'required|in:male,female,other',
            'password' => 'nullable|min:8|confirmed',
            'profile_picture' => 'nullable|image|max:2048',
        ];
    }
}

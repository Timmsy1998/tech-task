<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Domain\User\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_index_displays_users()
    {
        User::factory()->count(3)->create();

        $response = $this->get(route('users.index'));

        $response->assertStatus(200);
        $response->assertViewIs('users.index');
        $response->assertViewHas('users');
    }

    public function test_user_can_be_created()
    {
        Storage::fake('public');

        $response = $this->post(route('users.store'), [
            'name' => 'Test',
            'surname' => 'User',
            'email' => 'test@example.com',
            'phone' => '123456789',
            'country' => 'US',
            'gender' => 'male',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'profile_picture' => UploadedFile::fake()->image('avatar.jpg'),
        ]);

        $response->assertRedirect(route('users.index'));
        $this->assertDatabaseHas('users', ['email' => 'test@example.com']);
        Storage::disk('public')->assertExists(User::first()->profile_picture);
    }

    public function test_user_details_are_visible()
    {
        $user = User::factory()->create();

        $response = $this->get(route('users.show', $user));

        $response->assertStatus(200);
        $response->assertViewIs('users.show');
        $response->assertViewHas('user');
    }

    public function test_user_edit_form_displays()
    {
        $user = User::factory()->create();

        $response = $this->get(route('users.edit', $user));

        $response->assertStatus(200);
        $response->assertViewIs('users.edit');
        $response->assertViewHas('user');
    }

    public function test_user_can_be_updated()
    {
        Storage::fake('public');

        $user = User::factory()->create();

        $response = $this->put(route('users.update', $user), [
            'name' => 'Updated',
            'surname' => 'User',
            'email' => 'updated@example.com',
            'phone' => '987654321',
            'country' => 'GB',
            'gender' => 'female',
            'password' => '',
            'password_confirmation' => '',
            'profile_picture' => UploadedFile::fake()->image('updated.jpg'),
        ]);

        $response->assertRedirect(route('users.index'));
        $this->assertDatabaseHas('users', ['email' => 'updated@example.com']);
    }

    public function test_user_can_be_deleted()
    {
        Storage::fake('public');

        $user = User::factory()->create([
            'profile_picture' => 'profiles/delete.jpg',
        ]);

        // Simulate uploaded file
        Storage::disk('public')->put('profiles/delete.jpg', 'fake');

        $response = $this->delete(route('users.destroy', $user));

        $response->assertRedirect(route('users.index'));
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
        Storage::disk('public')->assertMissing('profiles/delete.jpg');
    }
}

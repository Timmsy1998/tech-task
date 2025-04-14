<?php

namespace Tests\Feature\Domain\User\Actions;

use Tests\TestCase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use App\Domain\User\Models\User;
use App\Domain\User\Actions\CreateUserAction;
use App\Domain\User\Actions\UpdateUserAction;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserActionTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_create_a_user_via_the_create_user_action()
    {
        Storage::fake('public');

        $data = [
            'name' => 'Alice',
            'surname' => 'Smith',
            'email' => 'alice@example.com',
            'phone' => '123456789',
            'country' => 'US',
            'gender' => 'female',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
            'profile_picture' => UploadedFile::fake()->image('avatar.jpg'),
        ];

        $action = new CreateUserAction();
        $user = $action->execute($data);

        $this->assertDatabaseHas('users', [
            'email' => 'alice@example.com',
            'name' => 'Alice',
            'surname' => 'Smith',
        ]);

        /** @var \Illuminate\Filesystem\FilesystemAdapter $disk */
        Storage::disk('public')->assertExists($user->profile_picture);
    }

    public function test_it_can_update_a_user_via_the_update_user_action()
    {
        Storage::fake('public');

        $user = \Database\Factories\UserFactory::new()->create();

        $data = [
            'name' => 'Bob',
            'surname' => 'Jones',
            'email' => 'bob@example.com',
            'phone' => '987654321',
            'country' => 'GB',
            'gender' => 'male',
            'profile_picture' => UploadedFile::fake()->image('updated.jpg'),
        ];

        $action = new UpdateUserAction();
        $action->execute($user, $data);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'email' => 'bob@example.com',
            'surname' => 'Jones',
            'country' => 'GB',
        ]);

        /** @var \Illuminate\Filesystem\FilesystemAdapter $disk */
        Storage::disk('public')->assertExists($user->fresh()->profile_picture);
    }
}

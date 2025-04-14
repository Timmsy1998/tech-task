<?php

namespace Tests\Feature\Domain\User\Actions;

use Tests\TestCase;
use Illuminate\Support\Facades\Storage;
use App\Domain\User\Models\User;
use App\Domain\User\Actions\DeleteUserAction;
use App\Domain\User\Actions\GetUserAction;
use App\Domain\User\Actions\ListUsersAction;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExtendedUserActionTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_list_users()
    {
        User::factory()->count(5)->create();

        $users = (new ListUsersAction())->execute();

        $this->assertEquals(5, $users->total());
    }

    public function test_it_can_fetch_a_single_user()
    {
        $user = User::factory()->create();

        $fetched = (new GetUserAction())->execute($user->id);

        $this->assertEquals($user->email, $fetched->email);
    }

    public function test_it_can_delete_a_user_and_their_profile_picture()
    {
        Storage::fake('public');

        $user = User::factory()->create([
            'profile_picture' => 'profiles/deletable.jpg',
        ]);

        // Create fake file
        Storage::disk('public')->put($user->profile_picture, 'fake-content');

        (new DeleteUserAction())->execute($user);

        $this->assertDatabaseMissing('users', ['id' => $user->id]);
        Storage::disk('public')->assertMissing($user->profile_picture);
    }
}

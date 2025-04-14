<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Domain\User\Models\User;
use App\Domain\User\Actions\{
    CreateUserAction,
    UpdateUserAction,
    DeleteUserAction,
    ListUsersAction,
    GetUserAction
};

class UserController extends Controller
{
    /**
     * Display a paginated list of users.
     *
     * This uses the ListUsersAction to separate business logic from the controller.
     * Keeping the controller thin follows the principles of Clean Architecture / DDD.
     */
    public function index()
    {
        $users = (new ListUsersAction())->execute();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form to create a new user.
     *
     * No logic required here — just return the view.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a new user in the database.
     *
     * This method uses the StoreUserRequest for validation.
     * The CreateUserAction encapsulates creation logic (e.g., file upload, password hashing),
     * allowing us to keep this controller clean and testable.
     */
    public function store(StoreUserRequest $request)
    {
        (new CreateUserAction())->execute($request->validated());

        // Redirect back to user list with a success message
        return redirect()->route('users.index')->with('success', 'User created successfully!');
    }

    /**
     * Display the specified user's details.
     *
     * Uses a dedicated action to fetch the user by ID — decouples the controller from the ORM.
     */
    public function show($id)
    {
        $user = (new GetUserAction())->execute($id);

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     *
     * This uses route model binding, which resolves the User model automatically.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified user's data.
     *
     * Validation is handled by UpdateUserRequest.
     * UpdateUserAction is responsible for applying the update logic (e.g., password logic, profile picture).
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        (new UpdateUserAction())->execute($user, $request->validated());

        return redirect()->route('users.index')->with('success', 'User updated successfully!');
    }

    /**
     * Delete the specified user.
     *
     * DeleteUserAction handles cleanup — e.g., deleting the profile picture from storage.
     */
    public function destroy(User $user)
    {
        (new DeleteUserAction())->execute($user);

        return redirect()->route('users.index')->with('success', 'User deleted successfully!');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of users.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::all(); // Retrieve all users from the database
        return view('layouts.users.list-users', compact('users')); // Render the user list view with the retrieved users
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit($id)
    {
        $user = User::findOrFail($id); // Find the user with the given ID
        return view('layouts.users.edit-user', compact('user')); // Render the edit user view with the found user
    }

    /**
     * Update the specified user in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id); // Find the user with the given ID

        $userWithSameName = User::where('username', $request['username'])->where('id', '!=', $id)->first();
        if ($userWithSameName) {
            return redirect()->back()->with('error', 'The chosen user name is already taken. Please choose a different one.');
        }

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'email' => 'required|string|email|unique:users,email,' . $id,
            'password' => 'required|string|min:8',
        ]);

        $modifiedFields = [];
        if (!$this->validatePassword($data)) {
            return redirect()->back()->with('error', 'Invalid password. Try again.');
        }

        if ($user->name !== $data['name']) {
            $modifiedFields['name'] = $data['name'];
        }

        if ($user->username !== $data['username']) {
            $modifiedFields['username'] = $data['username'];
        }

        if ($user->email !== $data['email']) {
            $modifiedFields['email'] = $data['email'];
        }

        $user->update($data); // Update the user record in the database with the new data

        return redirect()->back()->with(['success' => '¡User data modified successfully!', 'modifiedFields' => $modifiedFields]); // Redirect back to the previous page with a success message and the modified fields
    }

    /**
     * Validate the user's password.
     *
     * @param  array  $data
     * @return bool
     */
    protected function validatePassword(array $data)
    {
        $user = Auth::user(); // Get the authenticated user

        if (!Hash::check($data['password'], $user->password)) { // Check if the provided password matches the user's stored password
            return false;
        }

        return true;
    }

        /**
         * Remove the specified user from the database.
         *
         * @param  int  $id
         * @return \Illuminate\Contracts\Support\Renderable
         */
        public function destroy($id)
    {
        $user = User::find($id); // Find the user with the given ID

        if ($user) {
            $username = $user->username;
            $user->delete(); // Delete the user from the database
            return redirect()->back()->with('success', 'User ' . $username . ' deleted successfully'); // Redirect back with a success message
        } else {
            return redirect()->back()->with('error', 'User not found'); // Redirect back with an error message
        }
    }
}

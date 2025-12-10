<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;


class UserController extends Controller
{
    // Show all users
    public function index()
    {

        $users = User::all();

        //  $users = User::paginate(10);

        return view('dashboard.users.index', compact('users'));
    }

    // Show form to create new user
    public function create()
    {
        return view('dashboard.users.create');
    }

    // Store new user
    public function store(UserStoreRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('users', 'public');
        }

        $data['password'] = Hash::make($data['password']);

        User::create($data);
        // dd($data['image']);


        return redirect()->route('users.index') ;



    }

    // Show user details
    public function show($id)
    {

         $user = User::findOrFail($id);

        return view('dashboard.users.show', compact('user'));
    }



public function edit($id)
{
    $user = User::findOrFail($id);
    return view('dashboard.users.edit', compact('user'));
}

public function update(UserUpdateRequest $request, $id)
{
    $user = User::findOrFail($id);

    $data = $request->validated();

    // Handle password
    if (!empty($data['password'])) {
        $data['password'] = Hash::make($data['password']);
    } else {
        unset($data['password']);
    }

    // Handle image upload
    if ($request->hasFile('image')) {
        // Delete old image if exists
        if ($user->image && Storage::disk('public')->exists($user->image)) {
            Storage::disk('public')->delete($user->image);
        }
        $data['image'] = $request->file('image')->store('users', 'public');
    }

    $user->update($data);

    return redirect()->route('users.index');
}

    // Delete user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
// Restore deleted user
    public function restore($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();

        return redirect()->route('users.index')->with('success', 'User restored successfully.');
    }


public function trash()
{

    $trashedUsers = User::onlyTrashed()->get();
    //  $trashedUsers = User::onlyTrashed()->paginate(15);




    return view('dashboard.users.trash', compact('trashedUsers'));
    // return view('dashboard.users.trashUsers', compact('trashedUsers'));
}









}

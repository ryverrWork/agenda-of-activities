<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function index()
    {
        return view('dashboard.pages.user');
    }

    public function data()
    {
        $query = User::where('role', '<>', 'super admin');

        // Create an instance of the DataTables class
        $dataTables = new DataTables();

        // Pass the query to the instance's query method
        return $dataTables->eloquent($query)->make(true);
    }

    public function store(Request $request)
    {
        $password = Hash::make($request->password);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password,
            'role' => $request->role,
        ]);

        return redirect(route('dashboard.users.index'));
    }

    public function edit(User $user)
    {

        return view('dashboard.pages.user-edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $password = Hash::make($request->password);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $password;
        $user->role = $request->role;

        $user->update();

        return redirect()->route('dashboard.users.index')->with('success', 'User updated successfully!');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->json(['success' => true]);
    }
}

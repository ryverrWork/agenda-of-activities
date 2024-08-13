<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class ProfileController extends Controller
{
    public function index()
    {
        return view('dashboard.pages.profile');
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

        return redirect(route('dashboard.profile.index'));
    }

}

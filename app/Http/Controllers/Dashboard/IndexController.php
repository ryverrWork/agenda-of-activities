<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            switch (auth()->user()->role) {
                case 'super admin':
                    return view('dashboard.pages.super-admin-home');

                case 'admin':
                    return view('dashboard.pages.admin-home');

                default:
                    return view('dashboard.pages.user-home'); // Fallback if no cases match
            }

        } else {
            return redirect('/dashboard');
        }

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class IndexController extends Controller
{
    /**
     * Display homepage
     */
    public function index(): View
    {
        return view('index', [

        ]);
    }
}

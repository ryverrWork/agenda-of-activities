<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\View\View;

class IndexController extends Controller
{
    /**
     * Display homepage
     */
    public function index(): View
    {
        $activities = Activity::where('status', 'approved')->orderBy('date', 'desc')->get();

        return view('index', [
            'activities' => $activities
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Setting;
use Illuminate\View\View;

class IndexController extends Controller
{
    /**
     * Display homepage
     */
    public function index(): View
    {
        $settings = Setting::find(1);
        $activities = Activity::where('status', 'approved')->orderBy('date', 'asc')->orderBy('time', 'asc')->get();

        return view('index', [
            'activities' => $activities,
            'settings' => $settings
        ]);
    }
}

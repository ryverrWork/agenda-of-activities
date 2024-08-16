<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Setting;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class IndexController extends Controller
{
    /**
     * Display homepage
     */
    public function index(): View
    {
        $settings = Setting::find(1);

        return view('index', [
            'settings' => $settings
        ]);
    }

    public function data()
    {
        $query = Activity::where('status', 'approved')
            ->where(function ($query) {
                $query->where('date', '>', now('Asia/Jakarta')->toDateString())
                    ->orWhere(function ($query) {
                        $query->where('date', '=', now('Asia/Jakarta')->toDateString())
                            ->where('time', '>', now('Asia/Jakarta')->toTimeString());
                    });
            })
            ->orderBy('date', 'asc')->orderBy('time', 'asc');

        // Create an instance of the DataTables class
        $dataTables = new DataTables();

        // Pass the query to the instance's query method
        return $dataTables->eloquent($query)->make(true);
    }
}

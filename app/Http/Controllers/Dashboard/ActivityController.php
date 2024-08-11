<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Activity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class ActivityController extends Controller
{
    public function data()
    {
        $query = Activity::query();

        // Create an instance of the DataTables class
        $dataTables = new DataTables();

        // Pass the query to the instance's query method
        return $dataTables->eloquent($query)->make(true);
    }

    public function dataApproved()
    {
        $query = Activity::where('status', 'approved')->query();

        // Create an instance of the DataTables class
        $dataTables = new DataTables();

        // Pass the query to the instance's query method
        return $dataTables->eloquent($query)->make(true);
    }

    public function store(Request $request)
    {
        dd($request);
    }
}

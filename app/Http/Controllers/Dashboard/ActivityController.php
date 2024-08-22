<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Activity;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class ActivityController extends Controller
{
    public function data()
    {
        $query = Activity::with('approvedBy');
        // Create an instance of the DataTables class
        $dataTables = new DataTables();

        // Pass the query to the instance's query method
        return $dataTables->eloquent($query)->make(true);
    }

    public function store(Request $request)
    {
        $date = Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d');

        if ($request->hasFile('file')) {
            $file = $request->file('file');

            // Generate a unique name for the file
            $fileName = time() . '-' . $file->getClientOriginalName();

            // Save the file to storage
            $path = $file->storeAs('uploads', $fileName, 'public'); // 'uploads' is the directory within 'storage/app/public'
        }

        Activity::create([
            'date' => $date,
            'day' => $request->day,
            'time' => $request->time,
            'name' => $request->activity,
            'location' => $request->location,
            'number_of_participants' => $request->number_of_participants,
            'person_in_charge' => $request->pic,
            'phone_number' => $request->phone_number,
            'notes' => $request->notes,
            'file_url' => $path,
            'status' => 'pending'
        ]);

        return redirect(route('dashboard.index'));
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:activities,id',
            'status' => 'required|string|in:approved,rejected',
        ]);

        $activity = Activity::find($request->id);
        if ($activity) {
            $activity->status = $request->status;
            $activity->approved_by = auth()->user()->id;
            $activity->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 400);
    }

    public function edit(Activity $activity)
    {

        return view('dashboard.pages.activity-edit', compact('activity'));
    }

    public function update(Request $request, Activity $activity)
    {
        $activity->date = $request->date;
        $activity->day = $request->day;
        $activity->time = $request->time;
        $activity->name = $request->activity;
        $activity->location = $request->location;
        $activity->number_of_participants = $request->number_of_participants;
        $activity->person_in_charge = $request->pic;
        $activity->phone_number = $request->phone_number;
        $activity->notes = $request->notes;

        if ($request->hasFile('file')) {
            $file = $request->file('file');

            // Generate a unique name for the file
            $fileName = time() . '-' . $file->getClientOriginalName();

            // Save the file to storage
            $path = $file->storeAs('uploads', $fileName, 'public'); // 'uploads' is the directory within 'storage/app/public'

            $activity->file_url = $path;
        }

        $activity->update();

        return redirect()->route('dashboard.index')->with('success', 'Activity updated successfully!');
    }

    public function destroy(Activity $activity)
    {
        $activity->delete();

        return response()->json(['success' => true]);
    }
}

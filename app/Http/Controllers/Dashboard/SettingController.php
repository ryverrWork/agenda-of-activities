<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Setting;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function index()
    {
        return view('dashboard.pages.settings');
    }

    public function store(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            // Generate a unique name for the file
            $fileName = time() . '-' . $file->getClientOriginalName();

            // Save the file to storage
            $path = $file->storeAs('uploads', $fileName, 'public'); // 'uploads' is the directory within 'storage/app/public'
        }

        $settings = Setting::find(1);
        if ($settings) {
            $settings->logo_url = $path;
            $settings->save();
        } else {
            Setting::create([
                'logo_url' => $path
            ]);
        }


        return redirect(route('dashboard.settings.index'));
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Activitylog\Models\Activity;

class VisitorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:visitor');
    }

    public function adminPanel(Request $request)
    {
        $loginActivity = Activity::where('log_name' , 'login-log')
            ->orderBy('created_at','desc')
            ->limit(10)
            ->get();
        $users = User::latest()->limit(3)->get();
        $timezone = $request->session()->pull('timezone', 'UTC');
        return view('admin.dashboard')->with([
            'users' => $users,
            'timezone' => $timezone,
            'activities' => $loginActivity,
        ]);
    }
}
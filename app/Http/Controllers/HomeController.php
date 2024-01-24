<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Spatie\Activitylog\Models\Activity;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        // $user = Auth::user();


        //
        // test if sspatie-permissions works correctly
        //
        // $user->assignRole('super-admin');
        // dd($user);

        // get the names of the user's roles
        // $roles = $user->getRoleNames();


        // if ($user->hasRole(['admin', 'super-admin'])) {
        //     $loginActivity = Activity::where('log_name' , 'login-log')
        //         ->orderBy('created_at','desc')
        //         ->limit(10)
        //         ->get();
        //     $users = User::latest()->limit(3)->get();
        //     $timezone = $request->session()->get('timezone', 'UTC');

        //     return view('admin.dashboard')->with([
        //         'users' => $users,
        //         'timezone' => $timezone,
        //         'activities' => $loginActivity,
        //     ]);
        // };

        return view('home');
    }

    public function adminPanel(Request $request)
    {
      $user = Auth::user();
      if ($user->hasRole(['admin', 'super-admin'])) {
        $loginActivity = Activity::where('log_name' , 'login-log')
            ->orderBy('created_at','desc')
            ->limit(10)
            ->get();
        $users = User::latest()->limit(3)->get();
        $timezone = $request->session()->get('timezone', 'UTC');

        return view('admin.dashboard')->with([
            'users' => $users,
            'timezone' => $timezone,
            'activities' => $loginActivity,
        ]);
      };

      return view('home');
    }
}

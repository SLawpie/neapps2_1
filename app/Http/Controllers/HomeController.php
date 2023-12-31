<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


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
    public function index()
    {
        $user = Auth::user();
        //
        // test if sspatie-permissions works correctly
        //
        // $user->assignRole('super-admin');
        // dd($user);

        // get the names of the user's roles
        // $roles = $user->getRoleNames();
        if ($user->hasRole(['admin', 'super-admin'])) {
            $users = User::latest()->limit(3)->get();
            return view('admin.dashboard')->with([
                'users' => $users,
            ]);
        };

        return view('home');
    }
}

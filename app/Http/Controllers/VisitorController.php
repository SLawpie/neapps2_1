<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class VisitorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:visitor');
    }

    public function adminPanel()
    {
        $users = User::latest()->limit(3)->get();
        return view('admin.dashboard')->with([
            'users' => $users,
        ]);
    }
}
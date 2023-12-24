<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminRoleController extends Controller
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

    public function show()
    {
        return view('admin.roles-list');
    }
}
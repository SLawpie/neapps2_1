<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;


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

    public function index()
    {
        // $roles = Role::all()->pluck('name');
        $roles = Role::all();
        return view('admin.roles-list')->with([
            'roles' => $roles,
        ]);
    }
}
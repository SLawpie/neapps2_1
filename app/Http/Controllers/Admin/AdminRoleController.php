<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;


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
        $roles = Role::all();
        // $roles = Role::whereNotIn('name', ['super-admin'])->get();
        return view('admin.roles.index')->with([
            'roles' => $roles,
        ]);
    }

    public function show($request) 
    {

        try {
            $decrypted = Crypt::decryptString($request);
        } catch (DecryptException $e) {
            return back()->with([
                'messagetype' => 'alert',
                'message' => 'Coś poszło nie tak!.'
            ]);
        }

        $role = Role::where('id', $decrypted)->first();
        
        $users = User::with('roles')->get()->filter(
            fn ($user) => $user->roles->where('id', $role->id)->toArray()
        );
        $permissions = Permission::with('roles')->get()->filter(
            fn ($permission) => $permission->roles->where('id', $role->id)->toArray()
        );

        return view('admin.roles.show')->with([
            'role' => $role,
            'permissions' => $permissions,
            'users' => $users
        ]);
    }

    public function create() 
    {

        return view('admin.roles.create');
    }

    public function store(Request $request) 
    {
        $request->validate([
            'new-name' => 'required|regex:/^[\pL\-_]+$/u|max:128|unique:roles,name',
        ]);
        $new_name =  $request->get('new-name');

        $permission = Role::create(['name' => $new_name]);

        return redirect()->route('admin.roles.index')->with([
            'messagetype' => 'success',
            'message' => 'Rola została utworzona'
        ]);
    }
}
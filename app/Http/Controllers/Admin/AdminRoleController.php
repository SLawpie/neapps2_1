<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;
use App\Http\Services\DecryptService;


class AdminRoleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index()
    {
        // $roles = Role::all();
        $roles = Role::whereNotIn('name', ['super-admin'])->get();

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

    public function edit($request) 
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
        $role_permissions = Permission::with('roles')->get()->filter(
            fn ($permission) => $permission->roles->where('id', $role->id)->toArray()
        );
        $permissions = Permission::all();

        return view('admin.roles.edit')->with([
            'role' => $role,
            'role_permissions' => $role_permissions,
            'permissions' => $permissions
        ]);
    }

    public function update(Request $request, $id) 
    {
        try {
            $decrypted = Crypt::decryptString($id);
        } catch (DecryptException $e) {
            // dd($e);
            return back()->with([
                'messagetype' => 'alert',
                'message' => 'Coś poszło nie tak!.'
            ]);
        }
        $role = Role::where('id', $decrypted)->first();
        $new_name = ($request->get('new-name') === $role->name) ? false : true;
        if ($new_name) {
            $request->validate([
                'new-name' => 'required|regex:/^[\pL\-_]+$/u|max:128|unique:roles,name',
            ]);
            $role->name = $request->get('new-name');
        }
        $set_permission = [];
        foreach ($request->all() as $item) {
            if (str_contains($item, "p-")) {
                $set_permission[] = trim($item, "p-");
            }
        }
        foreach(Permission::all() as $permission) {
            if (in_array($permission->id, $set_permission)) {
                $role->givePermissionTo($permission);
            } else {
                if ($role->hasPermissionTo($permission)) {
                    $role->revokePermissionTo($permission);
                }
            }
        }

        $users = User::with('roles')->get()->filter(
            fn ($user) => $user->roles->where('id', $role->id)->toArray()
        );
        $permissions = Permission::with('roles')->get()->filter(
            fn ($permission) => $permission->roles->where('id', $role->id)->toArray()
        );
        $role->save();

        return redirect()->route('admin.roles.show', $id)->with([
            'role' => $role,
            'permissions' => $permissions,
            'users' => $users,
            'messagetype' => 'success',
            'message' => 'Rola została zakutalizowana'
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

    public function destroy($id) 
    {
        $decrypted = DecryptService::decryptID($id);

        $role = Role::where('id', $decrypted)->first();
        
        $users = User::with('roles')->get()->filter(
            fn ($user) => $user->roles->where('id', $role->id)->toArray()
        );
        
        if (count($users) <> 0) {
            return back()->with([
                'messagetype' => 'alert',
                'message' => 'Ta rola przynależy do użytkownika.'
            ]);
        }

        $role->delete();
        // $deleted = DB::table('roles')->where('id', $decrypted)->delete();

        $roles = Role::whereNotIn('name', ['super-admin'])->get();
        return redirect()->route('admin.roles.index')->with([
            'roles' => $roles,
            'messagetype' => 'success',
            'message' => 'Rola została skasowane.'
        ]);

    }
}
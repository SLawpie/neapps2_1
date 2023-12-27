<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;

class AdminPermissionController extends Controller
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
        $permissions = Permission::all();
        return view('admin.permissions.index')->with([
            'permissions' => $permissions,
        ]);
    }

    public function show($request) {

        try {
            $decrypted = Crypt::decryptString($request);
        } catch (DecryptException $e) {
            dd($e);
            return back()->with([
                'messagetype' => 'alert',
                'message' => 'Coś poszło nie tak!.'
            ]);
        }

        $permission = Permission::where('id', $decrypted)->first();
        $roles = Role::with('permissions')->get()->filter(
            fn ($role) => $role->permissions->where('id', $permission->id)->toArray()
        );
        $users = User::with('permissions')->get();

        return view('admin.permissions.show')->with([
            'permission' => $permission,
            'roles' => $roles,
            'users' => $users
        ]);
    }

    public function edit($request) {
        try {
            $decrypted = Crypt::decryptString($request);
        } catch (DecryptException $e) {
            dd($e);
            return back()->with([
                'messagetype' => 'alert',
                'message' => 'Coś poszło nie tak!.'
            ]);
        }

        $permission = Permission::where('id', $decrypted)->first();

        return view('admin.permissions.edit')->with([
            'permission' => $permission
        ]);
    }

    public function update(Request $request, $id) {
        try {
            $decrypted = Crypt::decryptString($id);
        } catch (DecryptException $e) {
            // dd($e);
            return back()->with([
                'messagetype' => 'alert',
                'message' => 'Coś poszło nie tak!.'
            ]);
        }

        $request->validate([
            'new-name' => 'required|regex:/^[\pL\d\s\-]+$/u|max:128|unique:permissions,name',
        ]);

        $new_name =  $request->get('new-name');
        $permission = Permission::where('id', $decrypted)->first();
        $route = $request->get('route');
        if ($permission->name != $new_name) {
            $permission->name = $new_name;
            $permission->save();
            return back()->with([
                'permission' => $permission,
                'messagetype' => 'success',
                'message' => 'Nazwa została zmieniona'
            ]);
        }

        return  back()->with([
            'permission' => $permission,
            'messagetype' => 'info',
            'message' => 'Nie podano nowej nazwy'
        ]);
    }

    public function create() {

        return view('admin.permissions.create');
    }

    public function store(Request $request) {
        $request->validate([
            'new-name' => 'required|regex:/^[\pL\s\-]+$/u|max:128|unique:permissions,name',
        ]);
        $new_name =  $request->get('new-name');

        $permission = Permission::create(['name' => $new_name]);

        return redirect()->route('admin.permissions.index')->with([
            'messagetype' => 'success',
            'message' => 'Uprawnienie zostało utworzone'
        ]);
    }

    public function destroy($request) {

        try {
            $decrypted = Crypt::decryptString($request);
        } catch (DecryptException $e) {
            dd($e);
            return back()->with([
                'messagetype' => 'alert',
                'message' => 'Coś poszło nie tak!.'
            ]);
        }

        $permission = Permission::where('id', $decrypted)->first();
        $roles = Role::with('permissions')->get()->filter(
            fn ($role) => $role->permissions->where('id', $permission->id)->toArray()
        );

        if (count($roles) <> 0) {
            return back()->with([
                'messagetype' => 'alert',
                'message' => 'To uprawnienie przynależy do którejś z ról.'
            ]);
        }

        $permission->delete();

        return redirect()->route('admin.permissions.index')->with([
            'messagetype' => 'success',
            'message' => 'Uprawnienie zostało skasowane.'
        ]);

    }
}
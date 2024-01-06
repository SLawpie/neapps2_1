<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AdminUserController extends Controller
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
        $users = User::orderBy('id', 'asc')->get();
        return view('admin.users.index')->with([
            'users' => $users,
        ]);
    }

    // public function show($request) 
    // {

    //     try {
    //         $decrypted = Crypt::decryptString($request);
    //     } catch (DecryptException $e) {
    //         return back()->with([
    //             'messagetype' => 'alert',
    //             'message' => 'Coś poszło nie tak!.'
    //         ]);
    //     }

    //     $role = Role::where('id', $decrypted)->first();
        
    //     $users = User::with('roles')->get()->filter(
    //         fn ($user) => $user->roles->where('id', $role->id)->toArray()
    //     );
    //     $permissions = Permission::with('roles')->get()->filter(
    //         fn ($permission) => $permission->roles->where('id', $role->id)->toArray()
    //     );

    //     return view('admin.roles.show')->with([
    //         'role' => $role,
    //         'permissions' => $permissions,
    //         'users' => $users
    //     ]);
    // }

    // public function edit($request) 
    // {
    //     try {
    //         $decrypted = Crypt::decryptString($request);
    //     } catch (DecryptException $e) {
    //         return back()->with([
    //             'messagetype' => 'alert',
    //             'message' => 'Coś poszło nie tak!.'
    //         ]);
    //     }

    //     $role = Role::where('id', $decrypted)->first();
    //     $role_permissions = Permission::with('roles')->get()->filter(
    //         fn ($permission) => $permission->roles->where('id', $role->id)->toArray()
    //     );
    //     $permissions = Permission::all();

    //     return view('admin.roles.edit')->with([
    //         'role' => $role,
    //         'role_permissions' => $role_permissions,
    //         'permissions' => $permissions
    //     ]);
    // }

    // public function update(Request $request, $id) 
    // {
    //     try {
    //         $decrypted = Crypt::decryptString($id);
    //     } catch (DecryptException $e) {
    //         return back()->with([
    //             'messagetype' => 'alert',
    //             'message' => 'Coś poszło nie tak!.'
    //         ]);
    //     }
    //     $role = Role::where('id', $decrypted)->first();
    //     $new_name = ($request->get('new-name') === $role->name) ? false : true;
    //     if ($new_name) {
    //         $request->validate([
    //             'new-name' => 'required|regex:/^[\pL\-_]+$/u|max:128|unique:roles,name',
    //         ]);
    //         $role->name = $request->get('new-name');
    //     }

    //     foreach ($request->all() as $item) {
    //         if (str_contains($item, "p-")) {
    //             $perm = trim($item, "p-");
    //             $role->givePermissionTo(Permission::where('id', $perm)->first()->name);
    //         }
    //     }

    //     $users = User::with('roles')->get()->filter(
    //         fn ($user) => $user->roles->where('id', $role->id)->toArray()
    //     );
    //     $permissions = Permission::with('roles')->get()->filter(
    //         fn ($permission) => $permission->roles->where('id', $role->id)->toArray()
    //     );
    //     $role->save();

    //     return redirect()->route('admin.roles.show', $id)->with([
    //         'role' => $role,
    //         'permissions' => $permissions,
    //         'users' => $users,
    //         'messagetype' => 'success',
    //         'message' => 'Rola została zakutalizowana'
    //     ]);

    // }

    public function create() 
    {

        return view('admin.users.create');
    }

    public function store(Request $request) 
    {
        $request->validate([
            'new-username' => 'required|alpha_num|max:128|unique:users,username',
            'new-firstname' => 'required|alpha|max:128',
            'new-password' => 'required|regex:/^.*(?=.*[a-zA-Z])(?=.*\d)(?=.*[!#$%&? "]).*$/u|min:6|max:30',
            'confirm-newpassword' => 'same:new-password',
        ]);

        User::create([
            'username' =>  $request->get('new-username'),
            'firstname' =>  $request->get('new-firstname'),
            'lastname' =>  $request->get('new-lastname'),
            'email' =>  $request->get('new-email'),
            'password' =>  Hash::make($request->get('new-password')),
        ]);

        return redirect()->route('admin.users.index')->with([
                    'messagetype' => 'success',
                    'message' => 'Użytkownik został utworzony'
                ]);
    }

    // public function destroy($request) 
    // {

    //     try {
    //         $decrypted = Crypt::decryptString($request);
    //     } catch (DecryptException $e) {
    //         return back()->with([
    //             'messagetype' => 'alert',
    //             'message' => 'Coś poszło nie tak!.'
    //         ]);
    //     }

    //     $role = Role::where('id', $decrypted)->first();
    //     $users = User::with('roles')->get()->filter(
    //         fn ($user) => $user->roles->where('id', $role->id)->toArray()
    //     );

    //     if (count($users) <> 0) {
    //         return back()->with([
    //             'messagetype' => 'alert',
    //             'message' => 'Ta rola przynależy do użytkownika.'
    //         ]);
    //     }

    //     $role->delete();

    //     return redirect()->route('admin.roles.index')->with([
    //         'messagetype' => 'success',
    //         'message' => 'Rola została skasowane.'
    //     ]);

    // }
}
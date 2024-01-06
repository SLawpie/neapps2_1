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

    public function show($request) {
        
        try {
            $decrypted = Crypt::decryptString($request);
        } catch (DecryptException $e) {
            return back()->with([
                'messagetype' => 'alert',
                'message' => 'Coś poszło nie tak!.'
            ]);
        }

        $user = User::where('id', $decrypted)->first();
        $roles = $user->getRoleNames();

        return view('admin.users.show')->with([
            'user' => $user,
            'roles' => $roles,
        ]);
    }


    public function edit($request) {
        try {
            $decrypted = Crypt::decryptString($request);
        } catch (DecryptException $e) {
            return back()->with([
                'messagetype' => 'alert',
                'message' => 'Coś poszło nie tak!.'
            ]);
        }

        $user = User::where('id', $decrypted)->first();

        return view('admin.users.edit')->with([
            'user' => $user,
        ]);

    }


    public function update(Request $request, $id) 
    {
        try {
            $decrypted = Crypt::decryptString($id);
        } catch (DecryptException $e) {
            return back()->with([
                'messagetype' => 'alert',
                'message' => 'Coś poszło nie tak!.'
            ]);
        }

        $request->validate([
            'new-firstname' => 'required|alpha|max:128'
        ]);

        $user = User::where('id', $decrypted)->first();
        $set_role = [];
        foreach ($request->all() as $item) {
            if (str_contains($item, "r-")) {
                $set_role[] = trim($item, "r-");
            }
        }
        foreach(Role::all() as $role) {
            if (in_array($role->id, $set_role)) {
                $user->assignRole($role);
            } else {
                if ($user->hasRole($role->name)) {
                    $user->removeRole($role);
                }
            }
        }
        $user->firstname = $request->get('new-firstname');
        $user->lastname = $request->get('new-lastname');
        $user->email = $request->get('new-email');
        $user->save();

        $roles = $user->getRoleNames();
    
        return redirect()->route('admin.users.show', $id)->with([
            'user' => $user,
            'roles' => $roles,
            'messagetype' => 'success',
            'message' => 'Dane użytkownika zostały zakutalizowane'
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
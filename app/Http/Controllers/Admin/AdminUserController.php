<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Services\DecryptService;
use Illuminate\Support\Facades\Auth;



class AdminUserController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {   
    //
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

    if (Auth::user()->hasRole('visitor')) {
      return redirect()
        ->route('admin.users.index')
        ->with([
            'messagetype' => 'info',
            'message' => 'Konto gościa. Użytkownik nie został utworzony.'
        ]);
    }

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

  public function show($id) 
  {

    $decrypted = DecryptService::decryptID($id);

    $user = User::where('id', $decrypted)->first();
    $roles = $user->getRoleNames();
    $permissions = $user->getDirectPermissions();
    return view('admin.users.show')->with([
      'user' => $user,
      'roles' => $roles,
      'permissions' => $permissions,
    ]);
  }


  public function edit($id) 
  {

    $decrypted = DecryptService::decryptID($id);

    $user = User::where('id', $decrypted)->first();

    return view('admin.users.edit')->with([
      'user' => $user,
    ]);

  }


  public function update(Request $request, $id) 
  {

    $decrypted = DecryptService::decryptID($id);

    $request->validate([
      'new-firstname' => 'required|alpha|max:128'
    ]);

    $user = User::where('id', $decrypted)->first();
    $set_role = [];
    $set_permission = [];
    foreach ($request->all() as $item) {
      if (str_contains($item, "r-")) {
        $set_role[] = trim($item, "r-");
      }
      if (str_contains($item, "p-")) {
      $set_permission[] = trim($item, "p-");
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
    foreach(Permission::all() as $permission) {
      if (in_array($permission->id, $set_permission)) {
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
    $permissions = $user->getPermissionNames();

    return redirect()->route('admin.users.show', $id)->with([
      'user' => $user,
      'roles' => $roles,
      'permissions' => $permissions,
      'messagetype' => 'success',
      'message' => 'Dane użytkownika zostały zakutalizowane'
    ]);

  }

  public function changePasswordForm($id)
  {
    $decrypted = DecryptService::decryptID($id);
    
    return view('admin.users.change-password')->with([
      'user' => User::where('id', $decrypted)->first(),
    ]);;
  }

  public function changePassword(Request $request, $id) 
  {
    $decrypted = DecryptService::decryptID($id);

    $validatedData = $request->validate([
      'newpassword' => 'required',
      'confirm-newpassword' => 'same:newpassword'
    ]);

    $user = User::where('id', $decrypted)->first();

    $user->password = bcrypt($request->get('newpassword'));
    $user->save();

    return redirect()
      ->route('admin.users.edit', ['id' => $id])
      ->with([
          'messagetype' => 'success',
          'message' => 'Hasło zostało zmienione..'
      ]);
  }

  public function destroy($id) 
  {

    $decrypted = DecryptService::decryptID($id);

    $user = User::where('id', $decrypted)->first();
    
    $user->delete();

    return redirect()->route('admin.users.index')->with([
      'messagetype' => 'success',
      'message' => 'Użytkownik został usunięty.'
    ]);

  }
}
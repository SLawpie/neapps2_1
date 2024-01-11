<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        return view('user.show');
    }

    public function edit() 
    {
        return view('user.edit');
    }

    public function update(Request $request)
    {
        $request->validate([
            'new-username' => 'required|alpha_num|max:128',
            'new-firstname' => 'required|alpha|max:128',
            'new-lastname' => 'nullable|alpha|max:128',
        ]);

        $user = Auth::user();

        if ($user->hasRole('visitor')) {
            return redirect()
            ->route('user.show')
            ->with([
                'messagetype' => 'info',
                'message' => 'Konto gościa. Dane nie zostały zmienione.'
            ]);
        }

        $user->username = $request->get('new-username');
        $user->firstname = $request->get('new-firstname');
        $user->lastname = $request->get('new-lastname');
        $user->save();

        return redirect()
            ->route('user.show')
            ->with([
                'messagetype' => 'success',
                'message' => 'Dane zostały zmienione.'
            ]);
    }

    public function changePasswordForm()
    {

        return view('user.change-password');
    }

    public function changePassword(Request $request)
    {
        if (!(Hash::check($request->get('password'), Auth::user()->password))) {
            // The passwords no matches
            return back()
                ->with([
                    'messagetype' => 'alert',
                    'message' => 'Niepoprawne obecne hasło.'
                ]);
        }

        if(strcmp($request->get('password'), $request->get('new-password')) == 0) {
            //Current password and new password are same
            return back()
                ->with([
                    'messagetype' => 'alert',
                    'message' => 'Nowe hasło nie może być takie samo jak obecne.'
                ]);
        }

        $validatedData = $request->validate([
            'password' => 'required',
            'new-password' => 'required|regex:/^.*(?=.*[a-zA-Z])(?=.*\d)(?=.*[!#$%&? "]).*$/u|min:6|max:30',
            'confirm-newpassword' => 'same:new-password'
        ]);

        //Change Password
        $user = Auth::user();

        if ($user->hasRole('visitor')) {
            return redirect()
            ->route('user.show')
            ->with([
                'messagetype' => 'info',
                'message' => 'Konto gościa. Hasło nie zostało zmienione.'
            ]);
        }

        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        return redirect()
            ->route('user.show')
            ->with([
                'messagetype' => 'success',
                'message' => 'Hasło zostało zmienione..'
            ]);
    }
}
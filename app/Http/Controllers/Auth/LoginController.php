<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use App\Http\Services\IpService;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers; 

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $input = $request->all();
        
        $this->validate($request, [
                    'username' => 'required',
                    'password' => 'required',
                ]);
        $fieldType = filter_var($request
            ->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if(auth()
            ->attempt(array(
            $fieldType => $input['username'], 'password' => $input['password']
            )))
        {
            session(['timezone' => $input['timezone']]);

            activity('login-log')
            ->withProperties([  
                'ips' => IpService::getips($request),
                'userAgent' => IpService::getUserAgent($request),
            ])
            ->log("success");

            return redirect()->route('home');
        } else {
            activity('login-log')
                ->withProperties([
                    'username' => $input['username'],
                    'ips' => IpService::getIps($request),
                    'userAgent' => IpService::getUserAgent($request),
                ])
                ->log("error");

            return redirect()->back()
                    ->withInput()
                    ->withErrors([
                    'username' => trans('auth.failed'),
                    ]);
        }
    }

}

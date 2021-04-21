<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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

    public function redirectPath()
    {
        return \Tenant::isTenantRequest() ?
            route('tenant.home', \Request::route('environment')) :
            '/system/home';
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        $guard = \Tenant::isTenantRequest() ? 'tenant':'system';
        return \Auth::guard($guard);
    }

    public function logout(Request $request)
    {
        $url = $request->segment(1);

        $request->session()->flush();

        $request->session()->regenerate();

        //dd($url);
        $this->guard($this->guard())->logout();

        return redirect("/{$url}");

    }
}

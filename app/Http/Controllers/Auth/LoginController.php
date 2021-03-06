<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Services\Admin\AuthService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
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

    protected $service;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AuthService $service)
    {
        $this->middleware('guest')->except('logout');
        $this->service = $service;
    }

    public function getLogin()
    {
        return view('vendor.adminlte.login');
    }

    public function postLogin(LoginRequest $request)
    {
        $result = $this->service->login($request->all());

        if ($result) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('get_login')->withErrors(['login_fail' => 'Login failed, try again!']);
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('get_login');
    }
}

<?php

namespace Twedoo\Stone\Http\Controllers\Auth;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Twedoo\Stone\Http\Controllers\Controller;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function authenticated()
    {
        if (Auth::user()->type != null) {
            return redirect(app('urlBack'));
        }
        return redirect('/');
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout(Request $request)
    {
        if (!Auth::user()) {
            return redirect('login');
        }

        if (Auth::user()->type != null) {
            $this->guard()->logout();
            $request->session()->invalidate();
            return redirect(app('urlBack') . '/login');
        } else {
            $applocale = Session::get('applocale');
            $application = Session::get('application');
            $this->guard()->logout();
            $request->session()->invalidate();
            Session::put('applocale', $applocale);
            App::setLocale($applocale);
            Session::put('application', $application);
            return redirect('/');
        }
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function showLoginForm()
    {
        if (Auth::user()) {
            if (Auth::user()->type != null) {
                return redirect(app('urlBack'));
            } else {
                return redirect('login');
            }
        } else {
            return view('elements.super.auth.login');
        }

    }

}

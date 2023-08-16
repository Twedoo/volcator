<?php

namespace Twedoo\Volcator\Http\Controllers\Auth;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Twedoo\Volcator\Http\Controllers\Controller;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;

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
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function authenticated()
    {
        if (Auth::user()->type != null) {
            $token = Auth::user()->createToken('auth_token')->plainTextToken;
//            Session::put('access_token', $token);
            Cache::put('access_token', $token);
            return redirect(app('urlBack'));
        }
        return redirect(app('urlBack'));
    }


    /**
     * @param Request $request
     * @param null $redirectTo
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout(Request $request, $redirectTo = null)
    {
        if (!Auth::user()) {
            return redirect('login');
        }

        if (Auth::user()->type != null) {
            $current_user = Auth::user()->id;
            $applocale = Session::get('applocale');
            $application = Session::get('application');
            $space = Session::get('space');
            $this->guard()->logout();
            $request->session()->invalidate();
            Session::put('applocale', $applocale);
            App::setLocale($applocale);
            Cache::put('application-'.$current_user, $application, 10080);
            Cache::put('space-'.$current_user, $space, 10080);
            if ($redirectTo) {
                return redirect($redirectTo);
            }
            return redirect(app('urlBack') . '/login');
        } else {
            $current_user = Auth::user()->id;
            $applocale = Session::get('applocale');
            $application = Session::get('application');
            $space = Session::get('space');
            $this->guard()->logout();
            $request->session()->invalidate();
            Session::put('applocale', $applocale);
            App::setLocale($applocale);
            Cache::put('application-'.$current_user, $application, 10080);
            Cache::put('space-'.$current_user, $space, 10080);
            if ($redirectTo) {
                return redirect($redirectTo);
            }
            return redirect(app('urlBack') . '/login');
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

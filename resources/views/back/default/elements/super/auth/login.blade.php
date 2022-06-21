@extends('elements.layouts.app')

@section('content')
    <div class="padding-15">


        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                {{ Config::get('languages')[App::getLocale()] }}
            </a>
            <ul class="dropdown-menu">
                @foreach (Config::get('languages') as $lang => $language)
                    @if ($lang != App::getLocale())
                        <li>
                            <a href="{{ route('lang.switch', $lang) }}">{{$language}}</a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </li>


        <div class="login-box">

            <!-- login form -->
            <form action="{{ url(app('urlBack').'/login') }}" method="post" class="sky-form boxed">
                <header><i class="fa fa-users"></i> Sign In</header>
            {{ csrf_field() }}

            <!--
      <div class="alert alert-danger noborder text-center weight-400 nomargin noradius">
        Invalid Email or Password!
      </div>

      <div class="alert alert-warning noborder text-center weight-400 nomargin noradius">
        Account Inactive!
      </div>

      <div class="alert alert-default noborder text-center weight-400 nomargin noradius">
        <strong>Too many failures!</strong> <br />
        Please wait: <span class="inlineCountdown" data-seconds="180"></span>
      </div> -->


                <fieldset>

                    <section class="{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label class="label">E-mail</label>
                        <label class="input">
                            <i class="icon-append fa fa-envelope"></i>
                            <input type="email" name="email" value="{{ old('email') }}">
                            @if ($errors->has('email'))
                                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                            @endif
                            <span class="tooltip tooltip-top-right">Email Address</span>
                        </label>
                    </section>

                    <section class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label class="label">Password</label>
                        <label class="input">
                            <i class="icon-append fa fa-lock"></i>
                            <input type="password" name="password">
                            @if ($errors->has('password'))
                                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                            @endif
                            <b class="tooltip tooltip-top-right">Type your Password</b>
                        </label>
                        <label class="checkbox"><input type="checkbox" name="checkbox-inline" checked><i></i>Keep me
                            logged in</label>
                    </section>

                </fieldset>

                <footer>
                    <button type="submit" class="btn btn-primary pull-right">Sign In</button>
                    <div class="forgot-password pull-left">
                        <a href="{{ url(app('urlBack').'/password/reset') }}">Forgot password?</a> <br/>
                    </div>
                </footer>
            </form>
            <!-- /login form -->

            <hr/>


        </div>

    </div>
@endsection

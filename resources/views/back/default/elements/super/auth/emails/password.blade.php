Click here to reset your password: <a
        href="{{ $link = url(app('urlBack').'/password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>

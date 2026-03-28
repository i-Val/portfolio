<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Reset Password</title>
    </head>
    <body>
        <form method="POST" action="{{ route('password.store') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token ?? '' }}" />
            <input type="email" name="email" value="{{ $email ?? '' }}" />
            <input type="password" name="password" />
            <input type="password" name="password_confirmation" />
            <button type="submit">Reset</button>
        </form>
    </body>
</html>

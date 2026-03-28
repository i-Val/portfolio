<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Register</title>
    </head>
    <body>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <input type="text" name="name" />
            <input type="email" name="email" />
            <input type="password" name="password" />
            <input type="password" name="password_confirmation" />
            <button type="submit">Register</button>
        </form>
    </body>
</html>

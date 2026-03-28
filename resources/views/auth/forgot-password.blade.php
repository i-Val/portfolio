<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Forgot Password</title>
    </head>
    <body>
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <input type="email" name="email" />
            <button type="submit">Send reset link</button>
        </form>
    </body>
</html>

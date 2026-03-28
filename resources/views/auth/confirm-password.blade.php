<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Confirm Password</title>
    </head>
    <body>
        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf
            <input type="password" name="password" />
            <button type="submit">Confirm</button>
        </form>
    </body>
</html>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Verify Email</title>
    </head>
    <body>
        <p>Please verify your email address.</p>
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit">Resend verification</button>
        </form>
    </body>
</html>

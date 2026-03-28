<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Profile</title>
    </head>
    <body>
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PATCH')
            <input type="text" name="name" value="{{ auth()->user()->name }}" />
            <input type="email" name="email" value="{{ auth()->user()->email }}" />
            <button type="submit">Save</button>
        </form>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            @method('PUT')
            <input type="password" name="current_password" />
            <input type="password" name="password" />
            <input type="password" name="password_confirmation" />
            <button type="submit">Update Password</button>
        </form>

        <form method="POST" action="{{ route('profile.destroy') }}">
            @csrf
            @method('DELETE')
            <input type="password" name="password" />
            <button type="submit">Delete Account</button>
        </form>
    </body>
</html>

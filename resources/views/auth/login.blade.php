<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="shortcut icon" href='{{ asset("assets/admin/images/favicon.ico") }}'>
    <script src='{{ asset("assets/admin/js/layout.js") }}'></script>
    <link href='{{ asset("assets/admin/css/bootstrap.min.css") }}' rel="stylesheet" type="text/css" />
    <link href='{{ asset("assets/admin/css/icons.min.css") }}' rel="stylesheet" type="text/css" />
    <link href='{{ asset("assets/admin/css/app.min.css") }}' rel="stylesheet" type="text/css" />
    <link href='{{ asset("assets/admin/css/custom.min.css") }}' rel="stylesheet" type="text/css" />
</head>
<body class="bg-light">
    <div class="auth-page-wrapper pt-5">
        <div class="auth-page-content">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="text-center mt-sm-5 mb-4 text-muted">
                            <a href="{{ route('home') }}" class="d-inline-block auth-logo">
                                <img src='{{ asset("assets/admin/images/logo-dark.png") }}' alt="" height="30">
                            </a>
                        </div>

                        <div class="card">
                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">Welcome Back</h5>
                                    <p class="text-muted">Sign in to continue.</p>
                                </div>

                                @if (session('status'))
                                    <div class="alert alert-success">{{ session('status') }}</div>
                                @endif

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form class="mt-4" method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control" required autofocus autocomplete="username">
                                    </div>

                                    <div class="mb-3">
                                        <div class="float-end">
                                            @if (Route::has('password.request'))
                                                <a href="{{ route('password.request') }}" class="text-muted">Forgot password?</a>
                                            @endif
                                        </div>
                                        <label class="form-label" for="password">Password</label>
                                        <input id="password" type="password" name="password" class="form-control" required autocomplete="current-password">
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" @checked(old('remember'))>
                                        <label class="form-check-label" for="remember">Remember me</label>
                                    </div>

                                    <div class="mt-4">
                                        <button class="btn btn-primary w-100" type="submit">Sign In</button>
                                    </div>

                                    @if (Route::has('register'))
                                        <div class="mt-4 text-center">
                                            <p class="mb-0">Don't have an account? <a href="{{ route('register') }}" class="fw-semibold text-primary text-decoration-underline">Sign up</a></p>
                                        </div>
                                    @endif
                                </form>
                            </div>
                        </div>

                        <div class="mt-5 text-center text-muted">
                            <p class="mb-0">&copy; <script>document.write(new Date().getFullYear())</script></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src='{{ asset("assets/admin/js/plugins.js") }}'></script>
    <script src='{{ asset("assets/admin/js/app.js") }}'></script>
</body>
</html>

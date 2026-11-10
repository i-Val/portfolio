<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Maintenance</title>
    <link rel="shortcut icon" href="{{ $siteProfile?->favicon ? Storage::url($siteProfile->favicon) : asset('favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <div class="card">
                    <div class="card-body p-4">
                        <h1 class="h4 mb-3">We’ll be back soon</h1>
                        <p class="mb-0">{{ $maintenanceMessage ?: 'The site is currently under maintenance.' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>


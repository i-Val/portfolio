<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Maintenance</title>
    <link rel="shortcut icon" href="{{ $siteProfile?->favicon ? Storage::url($siteProfile->favicon) : asset('favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@300;400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <style>
        body {
            background-color: #000000;
            color: #ffffff;
            font-family: "IBM Plex Mono", monospace;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .maintenance-card {
            background-color: #0d0d0d;
            border: 1px solid #222222;
            border-radius: 8px;
            padding: 40px;
        }
        h1 {
            font-family: "Playfair Display", serif;
            font-size: 32px;
            font-weight: 700;
            color: #ffffff;
        }
        p {
            color: #a0a0a5;
            font-size: 16px;
            line-height: 28px;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-7 text-center">
                <div class="maintenance-card">
                    <h1 class="mb-3">We’ll be back soon</h1>
                    <p class="mb-0">{{ $maintenanceMessage ?: 'The site is currently under maintenance.' }}</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

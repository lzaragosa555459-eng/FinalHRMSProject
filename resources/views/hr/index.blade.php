<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <!-- ✅ NAVBAR ALWAYS ON TOP -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-white">
        <div class="container-fluid">

            <div class="ms-auto d-flex align-items-center">
                <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}"
                     class="rounded-circle me-2"
                     width="40"
                     height="40">

                <span class="text-white">
                    {{ Auth::user()->name ?? 'Guest' }}
                </span>
            </div>

        </div>
    </nav>

    <!-- ✅ PAGE CONTENT GOES HERE -->
    <div class="container mt-4">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
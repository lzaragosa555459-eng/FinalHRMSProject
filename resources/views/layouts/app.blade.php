<!DOCTYPE html>
<html>
<head>
    
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container-fluid">
        <div class="row">
            
            <!-- Sidebar -->
            <div class="col-md-2">
                @include('partials.sidebarEmployee')
            </div>

            <!-- Main Content -->
            <div class="col-md-9 p-5">
                @yield('content')
            </div>

        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
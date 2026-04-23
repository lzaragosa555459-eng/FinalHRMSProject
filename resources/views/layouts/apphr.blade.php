<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
/* DARK MODE GLOBAL */
body.dark-mode {
    background-color: #121212 !important;
    color: #e4e4e4;
}

/* Cards */
body.dark-mode .card {
    background-color: #1e1e1e;
    color: #fff;
}

/* Navbar */
body.dark-mode .navbar {
    background-color: #1a1a1a !important;
}

/* Inputs */
body.dark-mode .form-control,
body.dark-mode .form-select {
    background-color: #2a2a2a;
    color: #fff;
    border-color: #444;
}

/* Text muted */
body.dark-mode .text-muted {
    color: #aaa !important;
}
body {
    transition: background-color 0.3s ease, color 0.3s ease;
}
</style>
<body id="appBody">

    <div class="container-fluid">
        <div class="row">
            
            <!-- Sidebar -->
            <div class="col-md-2">
                @include('partials.sidebarHR')
            </div>

            <!-- Main Content -->
            <div class="col-md-9 p-5">
                @yield('content')
            </div>

        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    const toggle = document.getElementById('darkModeToggle');

    // APPLY SAVED MODE ON LOAD
    if (localStorage.getItem('darkMode') === 'enabled') {
        document.body.classList.add('dark-mode');
        if (toggle) toggle.checked = true;
    }

    // TOGGLE EVENT (only if toggle exists)
    if (toggle) {
        toggle.addEventListener('change', function () {
            if (this.checked) {
                document.body.classList.add('dark-mode');
                localStorage.setItem('darkMode', 'enabled');
            } else {
                document.body.classList.remove('dark-mode');
                localStorage.setItem('darkMode', 'disabled');
            }
        });
    }

});
</script>
</body>
</html>
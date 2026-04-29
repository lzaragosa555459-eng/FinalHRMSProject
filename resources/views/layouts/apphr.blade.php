<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>
<style>
/* ===== DARK MODE FULL UI ===== */

body.dark-mode {
    background-color: #121212 !important;
    color: #e4e4e4 !important;


}

/* 🟪 CARDS */
body.dark-mode .card {
    background-color: #1e1e1e !important;
    color: #ffffff !important;
    border: 1px solid #2c2c2c;
}

/* Card headers / footers */
body.dark-mode .card-header,
body.dark-mode .card-footer {
    background-color: #1a1a1a !important;
    border-color: #2c2c2c;
}

/* 🟪 ALL TEXT */
body.dark-mode h1,
body.dark-mode h2,
body.dark-mode h3,
body.dark-mode h4,
body.dark-mode h5,
body.dark-mode h6,
body.dark-mode p,
body.dark-mode span,
body.dark-mode small,
body.dark-mode label {
    color: #ffffff !important;
}

/* Muted text fix */
body.dark-mode .text-muted {
    color: #aaaaaa !important;
}

/* 🟪 LINKS */
body.dark-mode a {
    color: #b197fc;
}

/* 🟪 TABLE */
body.dark-mode table {
    color: #e4e4e4 !important;
}

body.dark-mode .table {
    background-color: #1e1e1e !important;
}

body.dark-mode .table thead th {
    background-color: #2a2a2a !important;
    color: #ffffff !important;
    border-color: #333 !important;
}

body.dark-mode .table tbody td {
    background-color: #1e1e1e !important;
    color: #e4e4e4 !important;
    border-color: #333 !important;
}

body.dark-mode .table tbody tr {
    background-color: #1e1e1e !important;
}

body.dark-mode .table-hover tbody tr:hover {
    background-color: #2a2a2a !important;
}

body.dark-mode thead {
    background-color: #1a1a1a !important;
}

body.dark-mode tbody tr {
    border-color: #2c2c2c;
}

/* 🟪 INPUTS */
body.dark-mode .form-control,
body.dark-mode .form-select {
    background-color: #2a2a2a !important;
    color: #ffffff !important;
    border: 1px solid #444;
}

body.dark-mode .form-control::placeholder {
    color: #bbb;
}

/* 🟪 NAVBAR */
body.dark-mode .navbar {
    background-color: #1a1a1a !important;
}

/* 🟪 BADGES */
body.dark-mode .badge {
    opacity: 0.9;
}

/* 🟪 LIGHT BACKGROUNDS FIX */
body.dark-mode .bg-light {
    background-color: #2a2a2a !important;
}
/* ===== CONTROLS DESIGN ===== */

.custom-search .input-group-text {
    background-color: #ffffff;
    border: none;
    color: #6f42c1;
}

.custom-search .form-control {
    border: none;
    background-color: #ffffff;
}

.custom-search {
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 10px rgba(0,0,0,0.05);
}

/* SELECT */
.custom-select {
    border: none;
    border-radius: 12px;
    background-color: #ffffff;
    box-shadow: 0 4px 10px rgba(0,0,0,0.05);
}

/* ===== DARK MODE ===== */

body.dark-mode .custom-search .input-group-text,
body.dark-mode .custom-search .form-control {
    background-color: #2a2a2a !important;
    color: #fff !important;
}

body.dark-mode .custom-select {
    background-color: #2a2a2a !important;
    color: #fff !important;
}

/* placeholder fix */
body.dark-mode .form-control::placeholder {
    color: #aaa;
}
body.dark-mode .pagination .page-link {
    background-color: #1e1e1e !important;
    color: #ffffff !important;
    border: 1px solid #333 !important;
}

body.dark-mode .pagination .page-item.active .page-link {
    background-color: #6f42c1 !important;
    border-color: #000000 !important;
    color: #ffffff !important;
}

body.dark-mode .pagination .page-link:hover {
    background-color: #333333 !important;
    color: #ffffff !important;
}

body.dark-mode .pagination .page-item.disabled .page-link {
    background-color: #151515 !important;
    color: #666 !important;
}
/* FORCE ALL TEXT INSIDE DARK MODE */
body.dark-mode,
body.dark-mode * {
    color: #eaeaea !important;
}

/* Fix muted text separately */
body.dark-mode .text-muted {
    color: #9aa0a6 !important;
}

/* Fix Bootstrap dark text utility */
body.dark-mode .text-dark {
    color: #eaeaea !important;
}

/* Fix inline purple headers you used */
body.dark-mode h1,
body.dark-mode h2,
body.dark-mode h3,
body.dark-mode h4,
body.dark-mode h5,
body.dark-mode h6 {
    color: #ffffff !important;
}
/* DARK MODE FIX FOR CUSTOM PURPLE BADGE */
body.dark-mode .bg-purple-subtle {
    background-color: #3a2a5c !important;
    color: #eaeaea !important;
}
body.dark-mode .member-count-badge{
    background-color: #3a2a5c !important;
    color: #eaeaea !important;
}
body.dark-mode .emp-position{
    background-color: #3a2a5c !important;
    color: #eaeaea !important;
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

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
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
flatpickr("#period_start", {
    dateFormat: "Y-m-d",
    allowInput: true
});

flatpickr("#period_end", {
    dateFormat: "Y-m-d",
    allowInput: true
});

flatpickr("#pay_date", {
    dateFormat: "Y-m-d",
    allowInput: true
});
</script>
</body>
</html>
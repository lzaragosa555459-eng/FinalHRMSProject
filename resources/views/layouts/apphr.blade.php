<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
     <link rel="icon" href="{{ asset('logo.png') }}" type="image/png">
    <script>
    (function () {
        const isDark = localStorage.getItem('darkMode') === 'enabled';

        document.addEventListener("DOMContentLoaded", () => {
            document.documentElement.classList.toggle('dark-mode', isDark);
            document.body.classList.toggle('dark-mode', isDark);
        });
    })();
    </script>
</head>
<style>
/* ===== DARK MODE FULL UI ===== */

body.dark-mode {
    background-color: #121212 !important;
    color: #e4e4e4 !important;


}
html.dark-mode body,
body.dark-mode {
    background-color: #121212 !important;
    color: #e4e4e4 !important;
}
.rating-note {
    background: #f3f0f7;
    color: #333;
    padding: 10px 14px;
    border-radius: 10px;
    font-size: 0.9rem;
    border: 1px solid #e5e5e5;
    transition: all 0.3s ease;
}

/* DARK MODE */
body.dark-mode .rating-note {
    background: #1f1f1f;
    color: #e0e0e0;
    border: 1px solid #333;
}
/* Dark Mode Overrides */
body.dark-mode .card-summary {
    background-color: #1e1e2d !important; /* Deep dark slate */
    border: 1px solid #323248 !important;
}

body.dark-mode .dark-text-white,
body.dark-mode h2,
body.dark-mode h4:not(.text-danger):not(.text-success),
body.dark-mode .fw-semibold {
    color: #ffffff !important;
}

body.dark-mode .text-muted {
    color: #a1a1c5 !important;
}
/* Base Circle Styles */
.initials-circle {
    width: 60px;          /* Adjust size as needed */
    height: 60px;         /* Must match width */
    display: flex;
    align-items: center;  /* Vertical center */
    justify-content: center; /* Horizontal center */
    font-size: 24px;      /* Big letter size */
    font-weight: 800;     /* Extra bold */
    border-radius: 50%;   /* Makes it a circle */
    background-color: #6f42c1; /* Your payroll purple */
    color: #ffffff;
    text-transform: uppercase;
}

/* Dark Mode Adjustment */
body.dark-mode .initials-circle {
    background-color: #4c2b91; /* Deeper purple */
    color: #f3f4f6;
    border: 2px solid #374151;
}
/* --- Force Background Colors in Dark Mode --- */

body.dark-mode .card-purple {
    background-color: #4c2b91 !important; /* Deep Royal Purple */
    color: #ffffff !important;
}

body.dark-mode .card-purple-light {
    /* Instead of light lavender, we use a dark plum so it looks "Dark Mode" but still Purple */
    background-color: #2a2438 !important; 
    color: #d1bdf2 !important;
    border: 1px solid #4b208c !important;
}
/* Dark Mode Overrides for Status Rows */
body.dark-mode .bg-light {
    background-color: #2a2438 !important; /* Dark plum background */
    border: 1px solid #3d3451 !important;
}

body.dark-mode .bg-light h5 {
    color: #ffffff !important;
}
/* Base Card State */
.card-modern {
    transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1), 
                box-shadow 0.3s ease;
    border: 1px solid rgba(0,0,0,0.05); /* Subtle border for definition */
}

/* Hover Movement */
.card-modern:hover {
    transform: translateY(-10px); /* Lifts the card up */
    box-shadow: 0 12px 24px rgba(111, 66, 193, 0.15) !important; /* Soft purple glow shadow */
}

/* Dark Mode Adjustment */
body.dark-mode .card-modern:hover {
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.4) !important;
    border-color: rgba(255, 255, 255, 0.1);
}

/* Subtle scale for the buttons inside when hovering the card */
.card-modern:hover .btn-soft {
    transform: scale(1.05);
}

.btn-soft {
    transition: transform 0.2s ease;
}
/* Ensure the dots stay bright and visible */
body.dark-mode .text-success .bi-circle-fill { color: #2ecc71 !important; }
body.dark-mode .text-danger .bi-circle-fill { color: #e74c3c !important; }
body.dark-mode .text-warning .bi-circle-fill { color: #f1c40f !important; }

/* Keep the labels visible next to the dots */
body.dark-mode .text-success { color: #2ecc71 !important; }
body.dark-mode .text-danger { color: #e74c3c !important; }
body.dark-mode .text-warning { color: #f1c40f !important; }
body.dark-mode .card-white {
    /* The white card follows your standard dark mode gray */
    background-color: #1e1e2d !important;
    color: #ffffff !important;
}

/* Ensure the labels inside stay readable */
body.dark-mode .card-purple-light p,
body.dark-mode .card-purple-light .text-muted {
    color: #a1a1c5 !important;
}

body.dark-mode .card-purple p {
    color: rgba(255, 255, 255, 0.7) !important;
}
/* Adjusting the Purple Card specifically for dark mode */
body.dark-mode .bg-payroll-purple {
    background-color: #4c2b91 !important; /* Slightly deeper purple for less eye strain */
}

/* Adjusting the Lavender Card specifically for dark mode */
body.dark-mode .bg-payroll-lavender {
    background-color: #2a2438 !important; /* Dark plum instead of light lavender */
}
body.dark-mode .rating-note strong {
    color: #ffffff;
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
/* =========================
   DARK MODE OVERRIDES
   (works when body has .dark-mode)
========================= */

body.dark-mode {
    background-color: #0f0f14;
    color: #e5e5e5;
}

/* CARD */
body.dark-mode .card-custom {
    background-color: #1b1b24;
    box-shadow: 0 10px 30px rgba(0,0,0,0.4);
}

/* HEADER */
body.dark-mode .header-gradient {
    background: linear-gradient(135deg, #2b174d, #1a0f2f);
}

/* TABLE */
body.dark-mode .table-custom thead {
    background-color: #2a2238;
}

body.dark-mode .table-custom th {
    color: #d7cfff;
}

body.dark-mode .table-custom td {
    color: #e5e5e5;
}

/* TEXT */
body.dark-mode .text-dark {
    color: #f1f1f1 !important;
}

body.dark-mode .text-muted {
    color: #a9a9a9 !important;
}

/* AVATAR */
body.dark-mode .avatar-placeholder {
    background-color: #2a2238;
    color: #c7b6ff;
}

/* BADGES */
body.dark-mode .badge-attended {
    background-color: #1f3a2f;
    color: #8ff0c2;
}

body.dark-mode .badge-pending {
    background-color: #2a2238;
    color: #c7b6ff;
}

/* FOOTER */
body.dark-mode .card-footer {
    background-color: #14141c !important;
    color: #b5b5b5;
}

/* LINKS / BUTTON HOVER FIX */
body.dark-mode a {
    color: #c7b6ff;
}

body.dark-mode a:hover {
    color: #ffffff;
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
.pagination .page-link {
    color: #6f42c1;
    border: 1px solid #e5d9ff;
}

.pagination .page-item.active .page-link {
    background-color: #6f42c1;
    border-color: #6f42c1;
    color: #fff;
}

.pagination .page-link:hover {
    background-color: #f1e9ff;
    color: #6f42c1;
    border-color: #6f42c1;
}
    body {
        background-color: #f3f0f7 !important;
        font-family: 'Segoe UI', Roboto, sans-serif;
        transition: all .3s ease;
    }

    .bg-purple-gradient {
        background: linear-gradient(135deg, #6f42c1 0%, #4b2a89 100%);
        color: white;
    }

    .text-purple { color: #6f42c1 !important; }

    .card-custom {
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        background-color: white;
        transition: .3s ease;
    }

    .scroll-container::-webkit-scrollbar {
        width: 5px;
    }

    .scroll-container::-webkit-scrollbar-thumb {
        background: #d1c4e9;
        border-radius: 10px;
    }

    /* ================= DARK MODE ================= */
    body.dark-mode {
        background-color: #121212 !important;
        color: #f1f1f1;
    }

    body.dark-mode .card-custom,
    body.dark-mode .bg-white,
    body.dark-mode .hover-shadow {
        background-color: #1e1e1e !important;
        color: #f1f1f1 !important;
        box-shadow: 0 4px 14px rgba(0,0,0,0.35);
    }

    body.dark-mode .text-muted {
        color: #b5b5b5 !important;
    }

    body.dark-mode .text-dark {
        color: #ffffff !important;
    }

    body.dark-mode .border,
    body.dark-mode .border-top {
        border-color: #333 !important;
    }
    html, body {
        height: 100%;
    }

    body.dark-mode {
        transition: background-color 0.3s ease, color 0.3s ease;
    }
    body.dark-mode .btn-light,
    body.dark-mode .btn-white {
        background-color: #2a2a2a !important;
        color: #fff !important;
        border-color: #444 !important;
    }

    body.dark-mode .bg-light {
        background-color: #2a2a2a !important;
    }

    body.dark-mode canvas {
        filter: brightness(0.92);
    }

    body.dark-mode .badge.bg-white {
        background-color: #2a2a2a !important;
        color: #fff !important;
    }

    body.dark-mode .border-danger-subtle {
        border-color: rgba(220,53,69,.35) !important;
    }
    body.dark-mode .input-group-text {
        background-color: #1b1b24;
        border: 1px solid #3a2f52;
        color: #c7b6ff;
    }
    body.dark-mode .card-summary {
        background-color: #1b1b24;
        border: 1px solid #2f2a3d;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.35);
    }
    body.dark-mode .border-gross {
        border-left: 4px solid #6f42c1;
    }
    /* ===== DARK MODE MONEY COLORS ===== */

    /* Ensure good readability for labels */
    body.dark-mode .text-muted {
        color: #b5b5b5 !important;
    }
    body.dark-mode .bi-moon-stars{
        color: white !important;
    }
    body:not(.dark-mode) #darkModeToggle {
        color: #ffffff; /* moon = white */
    }

    body.dark-mode #darkModeToggle {
        color: #ffd43b; /* sun = yellow */
    }
    /* GREEN (income / positive money) */
    body.dark-mode .text-success,
    body.dark-mode .fw-bold.text-success {
        color: #4ade80 !important; /* bright money green */
    }

    /* RED (deductions / negative money) */
    body.dark-mode .text-danger,
    body.dark-mode .fw-bold.text-danger {
        color: #ff6b6b !important; /* readable red in dark mode */
    }

    /* OPTIONAL: stronger emphasis for money cards */
    body.dark-mode .card-summary h4 {
        text-shadow: 0 0 10px rgba(0,0,0,0.4);
    }
    /* text colors */
    body.dark-mode .card-summary small {
        color: #a9a9a9 !important;
    }
    /* TOTAL DEDUCTION (RED THEME) */
    body.dark-mode .border-deduction {
        border-left: 4px solid #ff4d4d;
    }

    body.dark-mode .card-summary.border-deduction {
        background-color: #1b1b24;
        border: 1px solid #3a2a2a;
    }

    body.dark-mode .card-summary.border-deduction h4 {
        color: #ff6b6b !important;
    }

    body.dark-mode .card-summary.border-deduction i {
        color: #ff4d4d !important;
    }

    body.dark-mode .card-summary h4 {
        color: #f1f1f1 !important;
    }

    /* icon background */
    body.dark-mode .card-summary .bg-light {
        background-color: #2a2238 !important;
    }

    /* icon color */
    body.dark-mode .card-summary i {
        color: #c7b6ff !important;
    }
/* ===== FLATPICKR DARK MODE ===== */
body.dark-mode .flatpickr-calendar {
    background: #1e1e1e !important;
    border: 1px solid #333 !important;
    box-shadow: 0 8px 20px rgba(0,0,0,0.45) !important;
}

body.dark-mode .flatpickr-months,
body.dark-mode .flatpickr-weekdays {
    background: #1e1e1e !important;
}

body.dark-mode .flatpickr-current-month,
body.dark-mode .flatpickr-weekday,
body.dark-mode .flatpickr-day {
    color: #ffffff !important;
}

body.dark-mode .flatpickr-day:hover {
    background: #6f42c1 !important;
    color: #ffffff !important;
}

body.dark-mode .flatpickr-day.selected,
body.dark-mode .flatpickr-day.startRange,
body.dark-mode .flatpickr-day.endRange {
    background: #6f42c1 !important;
    border-color: #6f42c1 !important;
    color: white !important;
}

body.dark-mode .flatpickr-day.today {
    border-color: #9b6dff !important;
}

body.dark-mode .numInput,
body.dark-mode .flatpickr-monthDropdown-months {
    color: #ffffff !important;
    background: transparent !important;
}
</style>

<script>
if (localStorage.getItem('darkMode') === 'enabled') {
    document.documentElement.classList.add('dark-mode');
    document.body.classList.add('dark-mode');
}
</script>
<body id="appBody">

    <div class="container-fluid">
        <div class="row">
            
            <!-- Sidebar -->
            <div class="col-2">
                @include('partials.sidebarHR')
            </div>

            <!-- Main Content -->
            <div class="col-10 " style="margin-left: 12%;">
                @yield('content')
            </div>

        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const toggle = document.getElementById('darkModeToggle');

    const setMode = (isDark) => {
        document.documentElement.classList.toggle('dark-mode', isDark);
        document.body.classList.toggle('dark-mode', isDark);

        const icon = toggle?.querySelector('i');
        if (icon) {
            icon.classList.toggle('bi-moon-stars', !isDark);
            icon.classList.toggle('bi-sun', isDark);
        }

        localStorage.setItem('darkMode', isDark ? 'enabled' : 'disabled');
    };

    // LOAD SAVED MODE
    const saved = localStorage.getItem('darkMode') === 'enabled';
    setMode(saved);

    // CLICK TOGGLE (IMPORTANT: button, NOT change event)
    toggle?.addEventListener('click', () => {
        const isDark = document.body.classList.contains('dark-mode');
        setMode(!isDark);
    });
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
@if(session('success'))
    <div id="toast-success"
        style="
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background: #198754;
            color: white;
            padding: 14px 22px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,.15);
            z-index: 9999;
            transition: opacity .3s ease;
        ">
        {{ session('success') }}
    </div>

    <script>
        setTimeout(() => {
            const toast = document.getElementById('toast-success');

            if (toast) {
                toast.style.opacity = '0';

                setTimeout(() => toast.remove(), 300);
            }
        }, 3000);
    </script>
@endif
</body>
</html>
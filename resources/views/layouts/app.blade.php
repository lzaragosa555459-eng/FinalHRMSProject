<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CoreHR - @yield('title')</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="icon" href="{{ asset('logo.png') }}" type="image/png">
    <style>
        :root {
            --core-purple: #6f42c1;
            --dark-purple: #2d1a4d;
            --sidebar-width: 70px;
            --sidebar-expanded: 260px;
        }

        body {
            background-color: #f3f0f7;
            font-family: 'Inter', sans-serif;
            margin: 0;
        }

        /* --- Sidebar Styles --- */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background-color: var(--dark-purple);
            padding: 20px 10px;
            overflow-x: hidden;
            transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1), left 0.3s ease;
            z-index: 1050;
        }

        @media (min-width: 1025px) {
            .sidebar:hover { width: var(--sidebar-expanded); }
        }

        /* --- Content Wrapper --- */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            transition: margin-left 0.3s ease;
            min-height: 100vh;
            padding: 40px; /* Generous padding for a clean look */
        }

        /* --- Mobile Responsiveness --- */
        @media (max-width: 1024px) {
            .sidebar { left: -100px; width: var(--sidebar-expanded); }
            .sidebar.mobile-active { left: 0; box-shadow: 10px 0 50px rgba(0,0,0,0.5); }
            .main-wrapper { margin-left: 0; padding: 80px 20px 20px 20px; padding-top: 10px !important;}
            .sidebar-overlay {
                display: none; position: fixed; top: 0; left: 0;
                width: 100%; height: 100%; background: rgba(0,0,0,0.4); z-index: 1040;
            }
            .sidebar.mobile-active + .sidebar-overlay { display: block; }
        }

        .mobile-toggle {
            display: none; position: fixed; top: 15px; left: 15px; z-index: 1060;
            background: var(--core-purple); color: white; border: none;
            border-radius: 8px; width: 45px; height: 45px; font-size: 24px;
        }
        @media (max-width: 1024px) { .mobile-toggle { display: flex; align-items: center; justify-content: center; } }
        
        /* Sidebar Text Visibility */
        .sidebar .text { opacity: 0; margin-left: 15px; font-weight: 600; transition: opacity 0.2s; white-space: nowrap; }
        .sidebar:hover .text, .sidebar.mobile-active .text { opacity: 1; }
        .sidebar .nav-link { color: #b8a6d9; display: flex; align-items: center; padding: 12px; border-radius: 10px; margin-bottom: 8px; text-decoration: none; }
        .sidebar .nav-link.active { background: var(--core-purple); color: white; }

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
body.dark-mode {
    background-color: #121212 !important;
}

/* ALL CARDS */
body.dark-mode .card {
    background-color: #1e1e1e !important;
    color: #f1f1f1 !important;
    box-shadow: 0 4px 14px rgba(0,0,0,0.4);
}

/* NAVBAR */
body.dark-mode .navbar-custom {
    background-color: #1e1e1e !important;
    color: #ffffff !important;
}

/* TEXT MUTED FIX */
body.dark-mode .text-muted {
    color: #a9a9a9 !important;
}

/* BORDER FIX */
body.dark-mode .border {
    border-color: #333 !important;
}

/* LIGHT PURPLE CARD */
body.dark-mode .card-purple-light {
    background-color: #2a2238 !important;
    color: #e5dfff !important;
}

/* ICON BACKGROUNDS / SHADOWS */
body.dark-mode .shadow-sm {
    box-shadow: 0 4px 14px rgba(0,0,0,0.5) !important;
}
body.dark-mode .rounded-4 {
    background-color: #1e1e1e !important;
}
body.dark-mode .card-purple {
    background-color: #3a1f6b !important;
}
body.dark-mode h1,
body.dark-mode h2,
body.dark-mode h3,
body.dark-mode h4 {
    color: #ffffff !important;
}
/* ================= DARK MODE TABLE ================= */

body.dark-mode .attendance-container {
    background-color: #1e1e1e !important;
    box-shadow: 0 4px 14px rgba(0,0,0,0.4);
}

/* TABLE BACKGROUND */
body.dark-mode .custom-table {
    color: #eaeaea !important;
}

/* HEADER */
body.dark-mode .custom-table thead th {
    background-color: #2a2238 !important;
    color: #d7cfff !important;
    border-bottom: 1px solid #3a2f52 !important;
}

/* ROWS */
body.dark-mode .custom-table tbody td {
    background-color: #1e1e1e !important;
    color: #eaeaea !important;
    border-bottom: 1px solid #2c2c2c !important;
}

/* HOVER EFFECT */
body.dark-mode .custom-table tbody tr:hover td {
    background-color: #2a2a2a !important;
}

/* DATE COLOR FIX */
body.dark-mode .date-cell {
    color: #c7b6ff !important;
}

/* MUTED TEXT */
body.dark-mode .text-muted {
    color: #a9a9a9 !important;
}

/* ICON COLORS */
body.dark-mode .bi {
    color: inherit;
}
/* ================= DARK MODE EVENTS ================= */

body.dark-mode {
    background-color: #121212 !important;
}

/* MAIN CARD */
body.dark-mode .event-card {
    background-color: #1e1e1e !important;
    color: #f1f1f1 !important;
    box-shadow: 0 6px 18px rgba(0,0,0,0.5) !important;
}

/* CARD HEADER */
body.dark-mode .event-header {
    background-color: #2a2238 !important;
    border-bottom: 1px solid #3a2f52 !important;
}

/* TITLE */
body.dark-mode .event-title {
    color: #ffffff !important;
}

/* DESCRIPTION + TEXT */
body.dark-mode .text-muted,
body.dark-mode .text-secondary {
    color: #b5b5b5 !important;
}

/* INFO ITEMS */
body.dark-mode .info-item {
    color: #dcdcdc !important;
}

/* ICONS */
body.dark-mode .info-item i {
    color: #c7b6ff !important;
}

/* BOTTOM FOOTER */
body.dark-mode .bg-light {
    background-color: #1e1e1e !important;
    border-top: 1px solid #2f2a3d !important;
}

/* REGISTERED LABEL */
body.dark-mode .registered-label {
    background-color: #2a2238 !important;
    color: #c7b6ff !important;
}

/* EVENT TYPE TAG */
body.dark-mode .event-type-tag {
    background-color: #3a1f6b !important;
}

/* STATUS BADGE */
body.dark-mode .status-badge-soft {
    color: #d7cfff !important;
}
/* ================= DARK MODE LEAVE MANAGEMENT ================= */

body.dark-mode {
    background-color: #121212 !important;
}

/* MAIN CARD CONTAINER */
body.dark-mode .portal-card {
    background-color: #1e1e1e !important;
    box-shadow: 0 4px 14px rgba(0,0,0,0.5);
}

/* TABS HEADER */
body.dark-mode .nav-tabs-custom {
    background-color: #2a2238 !important;
    border-bottom: 1px solid #3a2f52 !important;
}

/* TAB TEXT */
body.dark-mode .nav-tabs-custom .nav-link {
    color: #bdbdbd !important;
}

body.dark-mode .nav-tabs-custom .nav-link.active {
    color: #d7cfff !important;
    border-bottom-color: #6f42c1 !important;
}

/* TABLE BACKGROUND */
body.dark-mode .table {
    color: #eaeaea !important;
}

/* TABLE HEADER */
body.dark-mode .table thead th {
    background-color: #2a2238 !important;
    color: #d7cfff !important;
    border-bottom: 1px solid #3a2f52 !important;
}

/* TABLE CELLS */
body.dark-mode .table td {
    background-color: #1e1e1e !important;
    color: #eaeaea !important;
    border-bottom: 1px solid #2c2c2c !important;
}

/* ROW HOVER */
body.dark-mode .table tbody tr:hover td {
    background-color: #2a2a2a !important;
}

/* HEADER SECTION TEXT */
body.dark-mode .header-section h1 {
    color: #ffffff !important;
}

body.dark-mode .text-muted {
    color: #a9a9a9 !important;
}

/* BUTTON */
body.dark-mode .btn-portal {
    background-color: #6f42c1 !important;
}

/* MODAL */
body.dark-mode .modal-content {
    background-color: #1e1e1e !important;
    color: #eaeaea !important;
}

body.dark-mode .form-control {
    background-color: #2a2a2a !important;
    color: #fff !important;
    border: 1px solid #3a3a3a !important;
}

body.dark-mode .form-control::placeholder {
    color: #aaa !important;
}
    body.dark-mode {
        background-color: #120b1f;
        color: #e6e6e6;
    }

    body.dark-mode .stat-card,
    body.dark-mode .perf-record-card {
        background: #1c122e;
        border-color: #2d1a4d;
        color: #e6e6e6;
    }

    body.dark-mode .perf-header {
        background: #241635;
        color: #cbb6ff;
        border-color: #2d1a4d;
    }

    body.dark-mode .comment-box {
        background: #241635;
        color: #d6d6d6;
        border-left-color: #6f42c1;
    }

    body.dark-mode .text-muted {
        color: #a8a8a8 !important;
    }

    body.dark-mode .header-section {
        border-color: #2d1a4d !important;
    }
    </style>
    @yield('styles')
</head>
<body>


    @include('partials.sidebarEmployee')

    <div class="sidebar-overlay" id="overlay"></div>

    <main class="main-wrapper" style="margin-left: 10px;">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const sidebar = document.getElementById('sidebar');
        const toggle = document.getElementById('menuToggle');
        const overlay = document.getElementById('overlay');

        if(toggle) {
            toggle.addEventListener('click', () => sidebar.classList.toggle('mobile-active'));
            overlay.addEventListener('click', () => sidebar.classList.remove('mobile-active'));
        }
    </script>
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
    </script>
    @yield('scripts')
</body>
</html>
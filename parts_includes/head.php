<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="opa-logo.ico">
    <title>OPA - Dashboard</title>

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Bootstrap v5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- MapLibre GL JS -->
    <link href="https://cdn.jsdelivr.net/npm/maplibre-gl@3.6.2/dist/maplibre-gl.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/maplibre-gl@3.6.2/dist/maplibre-gl.js"></script>

    <style>
        /* ════════════════════════════════════════
           THEME CSS VARIABLES
        ════════════════════════════════════════ */

        /* Theme 1: Default (Blue/Grey) */
        :root,
        [data-theme="default"] {
            --navbar-bg:          #E0E0E0;
            --navbar-text:        #1e1e1e;
            --card-bg:            #ffffff;
            --card-border:        #e0e0e0;
            --page-bg:            #f0f2f5;
            --accent:             #3aabcf;
            --accent-hover:       #2e99bb;
            --section-header-bg:  #ffffff;
            --reset-btn-bg:       #1a4bbd;
            --reset-btn-text:     #ffffff;
            --toggle-btn-bg:      #48bde1;
            --toggle-btn-text:    #ffffff;
            --table-header-bg:    #f8f9fa;
            --intervention-bg:    #f8f9fa;
            --dropdown-hover-bg:  #f0f2f5;
            --page-title-color:   #1e1e1e;
            --text-main:          #1e1e1e;
            --text-muted:         #8899a6;
            --text-meta:          #787777;
            --table-row-bg:       #ffffff;
            --table-header-text:  #555555;
            --scrollbar-color:    #dddddd;
        }

        /* Theme 2: Agriculture (Green/Gold) */
        [data-theme="agri"] {
            --navbar-bg:          #0C4527;
            --navbar-text:        #ffffff;
            --card-bg:            #F0AD4E;
            --card-border:        #ffffff;
            --page-bg:            #1A6B3C;
            --accent:             #27ae60;
            --accent-hover:       #1e8449;
            --section-header-bg:  #F0AD4E;
            --reset-btn-bg:       #F0AD4E;
            --reset-btn-text:     #0C4527;
            --toggle-btn-bg:      #27ae60;
            --toggle-btn-text:    #ffffff;
            --table-header-bg:    #d4922a;
            --intervention-bg:    #d4922a;
            --dropdown-hover-bg:  #d4922a;
            --page-title-color:   #ffffff;
            --text-main:          #1e1e1e;
            --text-muted:         #5a3200;
            --text-meta:          #5a3200;
            --table-row-bg:       #fde8b0;
            --table-header-text:  #3d1f00;
            --scrollbar-color:    #0C4527;
        }

        /* Theme 3: Ocean (Navy/Cyan) */
        [data-theme="ocean"] {
            --navbar-bg:          #06162D;
            --navbar-text:        #ffffff;
            --card-bg:            #67DAFE;
            --card-border:        #ffffff;
            --page-bg:            #1A3C6E;
            --accent:             #06162D;
            --accent-hover:       #0d2a4a;
            --section-header-bg:  #67DAFE;
            --reset-btn-bg:       #1A3C6E;
            --reset-btn-text:     #ffffff;
            --toggle-btn-bg:      #ffffff;
            --toggle-btn-text:    #06162D;
            --table-header-bg:    #3ec8f0;
            --intervention-bg:    #3ec8f0;
            --dropdown-hover-bg:  #3ec8f0;
            --page-title-color:   #ffffff;
            --text-main:          #06162D;
            --text-muted:         #06162D;
            --text-meta:          #06162D;
            --table-row-bg:       #b8f0ff;
            --table-header-text:  #06162D;
            --scrollbar-color:    #06162D;
        }

        /* ════════════════════════════════════════
           LIGHT MODE (default)
        ════════════════════════════════════════ */

        /* ── Global ── */
        body {
            background-color: var(--page-bg);
            font-family: 'Roboto', sans-serif;
            transition: background-color 0.3s, color 0.3s;
        }

        /* ── Navbar icons ── */
        .navbar-hamburger {
            color: var(--navbar-text);
            font-size: 24px;
            font-weight: 800;
            transition: color 0.3s;
        }
        .navbar-icon {
            color: var(--navbar-text);
            font-size: 18px;
            cursor: pointer;
            transition: color 0.3s;
        }
        .navbar-icon:hover {
            color: var(--navbar-text);
            opacity: 0.75;
        }

        /* ── Navbar ── */
        .top-navbar {
            background-color: var(--navbar-bg);
            padding: 8px 20px;
            transition: background-color 0.3s;
        }
        .top-navbar .nav-link {
            color: var(--navbar-text) !important;
            font-size: 14px;
        }
        .top-navbar .nav-link:hover {
            color: var(--navbar-text) !important;
        }
        .top-navbar .navbar-icons i {
            color: var(--navbar-text) !important;
            font-size: 18px;
            cursor: pointer;
        }

        /* ── Dropdown menus ── */
        .dropdown-menu {
            background-color: #ffffff;
            border: 1px solid #e0e0e0;
            transition: background-color 0.3s;
        }
        .dropdown-item {
            color: #1e1e1e;
        }
        .dropdown-item:hover {
            background-color: var(--dropdown-hover-bg);
        }

        /* ── Page Header ── */
        .page-header {
            padding: 16px 20px 0 20px;
        }
        .page-header h4 {
            font-weight: 700;
            font-size: 30px;
            color: var(--page-title-color);
            transition: color 0.3s;
        }
        .breadcrumb {
            font-size: 15px;
        }
        .breadcrumb-item.active {
            color: #6c757d;
        }

        /* ── Stats Cards ── */
        .stat-card {
            background: var(--card-bg);
            border-radius: 15px;
            padding: 22px;
            box-shadow: 0 3px 6px rgba(0,0,0,0.07);
            border: 2px solid var(--card-border);
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            height: 100%;
            min-height: 130px;
            transition: background-color 0.3s, border-color 0.3s;
        }
        .stat-card .stat-info h6 {
            font-size: 18px;
            color: var(--text-main);
            margin-bottom: 5px;
            font-weight: 700;
            transition: color 0.3s;
        }
        .stat-card .stat-info h3 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 5px;
            color: var(--text-main);
            transition: color 0.3s;
        }
        .stat-card .stat-info small {
            font-size: 12px;
            color: var(--text-muted);
        }
        .stat-card .stat-info .text-muted-sm {
            font-size: 12px;
            color: var(--text-muted);
        }
        .stat-card .stat-icon {
            width: 58px;
            height: 58px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            flex-shrink: 0;
            box-shadow: inset 0 5px 5px rgba(0,0,0,0.2);
        }

        /* ── Section Cards ── */
        .section-card {
            background: var(--card-bg);
            border-radius: 15px;
            box-shadow: 0 5px 6px rgba(0,0,0,0.07);
            overflow: hidden;
            border: 2px solid var(--card-border);
            transition: background-color 0.3s, border-color 0.3s;
        }
        .section-card .section-header {
            padding: 14px 16px;
            font-weight: 700;
            font-size: 18px;
            border-bottom: 1px solid var(--card-border);
            color: var(--text-main);
            background-color: var(--section-header-bg);
            transition: color 0.3s, border-color 0.3s, background-color 0.3s;
        }
        .section-card .section-body {
            padding: 14px 16px;
        }

        /* ── Recent Registrations ── */
        .reg-item {
            border-bottom: 1px solid #f5f5f5;
            padding: 10px 0;
            transition: border-color 0.3s;
        }
        .reg-item:last-child {
            border-bottom: none;
        }
        .reg-item .reg-name {
            font-weight: 600;
            font-size: 13px;
            color: var(--text-main);
            transition: color 0.3s;
        }
        .reg-item .reg-meta {
            font-size: 11px;
            color: var(--text-meta);
        }
        .reg-item .reg-date {
            font-size: 11px;
            color: var(--text-muted);
        }
        .reg-scrollable {
            max-height: 400px;
            overflow-y: auto;
        }

        /* ── Map Controls ── */
        .map-controls-panel {
            position: absolute;
            top: 16px;
            right: 16px;
            z-index: 3;
            background: #fff;
            border-radius: 8px;
            padding: 14px;
            width: 200px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
            font-size: 12px;
            color: #1e1e1e;
            transition: background-color 0.3s, color 0.3s;
        }
        .map-controls-panel .controls-title {
            font-weight: 700;
            font-size: 13px;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .map-controls-panel .text-muted {
            color: #6c757d !important;
        }
        .map-controls-panel .form-check-label {
            color: inherit;
        }
        .legend-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 5px;
        }
        .legend-square {
            width: 12px;
            height: 12px;
            display: inline-block;
            margin-right: 5px;
        }

        /* ── Map Controls Toggle Animation ── */
        #mapControlsBody {
            overflow: hidden;
            transition: max-height 0.3s ease, opacity 0.3s ease;
            max-height: 500px;
            opacity: 1;
        }
        #mapControlsBody.collapsed {
            max-height: 0;
            opacity: 0;
        }

        /* ── Damage Table ── */
        .table th {
            font-size: 12px;
            font-weight: 700;
            color: var(--table-header-text);
            background: var(--table-header-bg);
            transition: background-color 0.3s, color 0.3s;
        }
        .table td {
            font-size: 13px;
            vertical-align: middle;
            color: var(--text-main);
            transition: color 0.3s;
        }
        .table tbody tr {
            border-color: #e0e0e0;
            background-color: var(--table-row-bg);
            transition: background-color 0.3s;
        }
        .badge-high {
            background-color: #e74c3c;
            color: #fff;
            padding: 4px 10px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
        }

        /* ── Form Select (chart filter) ── */
        .form-select {
            background-color: #fff;
            color: #1e1e1e;
            border-color: #e0e0e0;
            transition: background-color 0.3s, color 0.3s, border-color 0.3s;
        }

        /* ── Recent Interventions ── */
        .intervention-item {
            background: var(--intervention-bg);
            border-radius: 8px;
            padding: 12px;
            margin-bottom: 10px;
            transition: background-color 0.3s;
        }
        .intervention-item .int-meta {
            font-size: 12px;
            color: var(--text-meta);
        }
        .intervention-item .int-name {
            font-weight: 600;
            font-size: 13px;
            color: var(--text-main);
            transition: color 0.3s;
        }
        .intervention-item .int-detail {
            font-size: 12px;
            color: #ac0b0b;
        }
        .badge-active {
            background-color: #27ae60;
            color: #fff;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 11px;
        }

        /* ── Footer ── */
        .dashboard-footer {
            text-align: center;
            padding: 16px;
            font-size: 12px;
            color: #aaa;
            transition: color 0.3s;
        }

        /* ── Scrollbar ── */
        .reg-scrollable::-webkit-scrollbar { width: 6px; }
        .reg-scrollable::-webkit-scrollbar-thumb { background: var(--scrollbar-color); border-radius: 2px; }

        /* ── MapLibre controls z-index ── */
        .maplibregl-ctrl-top-left {
            z-index: 2 !important;
        }

        /* ══ THEME PANEL — structure (no inline styles needed) ══ */

        /* Floating toggle tab */
        #themeToggleBtn {
            position: fixed;
            right: 0;
            top: 90%;
            transform: translateY(-50%);
            z-index: 999;
            background: var(--toggle-btn-bg);
            color: var(--toggle-btn-text);
            width: 40px;
            height: 50px;
            border-radius: 8px 0 0 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: -2px 3px 8px rgba(0,0,0,0.2);
            transition: right 0.2s ease-in-out, background 0.3s;
        }
        #themeToggleBtn i { font-size: 18px; }

        /* Sliding panel */
        #themePanel {
            position: fixed;
            right: -320px;
            top: 0;
            width: 320px;
            height: 100%;
            background: #ffffff;
            color: #1e1e1e;
            z-index: 998;
            box-shadow: -4px 0 16px rgba(0,0,0,0.15);
            transition: right 0.2s ease-in-out, background-color 0.3s, color 0.3s;
            overflow-y: auto;
            padding: 24px;
            border-left: 1px solid #e0e0e0;
        }

        /* Panel text elements */
        .tp-title {
            font-weight: 600;
            font-size: 18px;
            margin-bottom: 16px;
            color: #1e1e1e;
            transition: color 0.3s;
        }
        .tp-label {
            font-size: 14px;
            font-weight: 500;
            color: #1e1e1e;
            transition: color 0.3s;
        }
        .tp-section-label {
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 12px;
            color: #1e1e1e;
            transition: color 0.3s;
        }
        .tp-font-label {
            font-size: 14px;
            font-weight: 700;
            color: #1e1e1e;
            transition: color 0.3s;
        }
        .tp-font-value {
            font-size: 14px;
            color: #1e1e1e;
            transition: color 0.3s;
        }
        .tp-divider {
            border-color: #e0e0e0;
            transition: border-color 0.3s;
        }

        /* Mode toggle switch */
        #modeToggle {
            width: 48px;
            height: 26px;
            background: #ccc;
            border-radius: 50px;
            position: relative;
            cursor: pointer;
            transition: background 0.3s;
        }
        #modeToggleCircle {
            position: absolute;
            top: 3px;
            left: 3px;
            width: 20px;
            height: 20px;
            background: #fff;
            border-radius: 50%;
            transition: left 0.3s;
        }

        /* Color theme circles */
        .color-theme-option {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            cursor: pointer;
            box-shadow: 0 0 0 3px transparent;
            transition: box-shadow 0.2s;
            flex-shrink: 0;
        }

        /* +/- buttons */
        .tp-btn {
            background: #e0e0e0 !important;
            color: #1e1e1e !important;
            border: none !important;
            font-weight: 700;
            transition: background-color 0.3s, color 0.3s;
        }
        .tp-btn:hover {
            background: #bdbdbd !important;
        }

        /* Reset All button */
        .tp-reset-btn {
            background: var(--reset-btn-bg);
            color: var(--reset-btn-text);
            font-weight: 600;
            padding: 12px;
            border-radius: 8px;
            margin-top: 20px;
            transition: background 0.3s, color 0.3s;
        }
        .tp-reset-btn:hover {
            background: var(--accent-hover);
            color: var(--reset-btn-text);
        }

        /* Sliders */
        #themePanel input[type="range"] {
            border-radius: 50px;
            height: 6px;
            border: none;
            outline: none;
            -webkit-appearance: none;
            appearance: none;
            background: #e0e0e0;
            transition: background 0.3s;
        }
        #themePanel input[type="range"]::-webkit-slider-runnable-track {
            height: 6px;
            border-radius: 50px;
            background: inherit;
        }
        #themePanel input[type="range"]::-webkit-slider-thumb {
            -webkit-appearance: none;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: #48bde1;
            margin-top: -5px;
            cursor: pointer;
        }


        /* ════════════════════════════════════════
           DARK MODE
        ════════════════════════════════════════ */

        body.dark-mode {
            background-color: #1e2530;
            color: #e0e0e0;
        }

        /* Navbar */
        body.dark-mode .top-navbar {
            background-color: #161d28;
        }
        body.dark-mode .top-navbar .nav-link {
            color: #e0e0e0 !important;
        }
        body.dark-mode .top-navbar .nav-link:hover {
            color: #ffffff !important;
        }
        body.dark-mode .top-navbar .navbar-icons i {
            color: #e0e0e0 !important;
        }
        body.dark-mode .navbar-hamburger {
            color: #e0e0e0;
        }
        body.dark-mode .navbar-icon {
            color: #e0e0e0;
        }
        body.dark-mode .navbar-icon:hover {
            color: #ffffff;
        }

        /* Dropdown menus */
        body.dark-mode .dropdown-menu {
            background-color: #252d3a;
            border-color: #3a4556;
        }
        body.dark-mode .dropdown-item {
            color: #e0e0e0;
        }
        body.dark-mode .dropdown-item:hover {
            background-color: #2d3748;
            color: #ffffff;
        }

        /* Page Header */
        body.dark-mode .page-header h4 {
            color: #ffffff;
        }
        body.dark-mode .breadcrumb-item.active {
            color: #8899a6;
        }
        body.dark-mode .breadcrumb-item + .breadcrumb-item::before {
            color: #8899a6;
        }

        /* Stat Cards */
        body.dark-mode .stat-card {
            background: #252d3a;
            border-color: #3a4556;
            box-shadow: 0 3px 6px rgba(0,0,0,0.3);
        }
        body.dark-mode .stat-card .stat-info h6 {
            color: #e0e0e0;
        }
        body.dark-mode .stat-card .stat-info h3 {
            color: #ffffff;
        }
        body.dark-mode .stat-card .stat-info small,
        body.dark-mode .stat-card .stat-info .text-muted-sm {
            color: #8899a6;
        }

        /* Section Cards */
        body.dark-mode .section-card {
            background: #252d3a;
            border-color: #3a4556;
            box-shadow: 0 5px 6px rgba(0,0,0,0.3);
        }
        body.dark-mode .section-card .section-header {
            color: #e0e0e0;
            border-bottom-color: #3a4556;
            background-color: #252d3a;
        }

        /* Recent Registrations */
        body.dark-mode .reg-item {
            border-bottom-color: #3a4556;
        }
        body.dark-mode .reg-item .reg-name {
            color: #e0e0e0;
        }
        body.dark-mode .reg-item .reg-meta {
            color: #8899a6;
        }
        body.dark-mode .reg-item .reg-date {
            color: #6a7d8e;
        }
        body.dark-mode .reg-scrollable::-webkit-scrollbar-thumb {
            background: #3a4556;
        }

        /* Map Controls Panel */
        body.dark-mode .map-controls-panel {
            background: #252d3a;
            color: #e0e0e0;
            box-shadow: 0 2px 8px rgba(0,0,0,0.5);
        }
        body.dark-mode .map-controls-panel .text-muted {
            color: #8899a6 !important;
        }
        body.dark-mode .map-controls-panel .form-check-input {
            background-color: #3a4556;
            border-color: #5a6a7e;
        }
        body.dark-mode .map-controls-panel .form-check-label {
            color: #e0e0e0;
        }

        /* Damage Table */
        body.dark-mode .table th {
            background-color: #2d3748;
            color: #a0aec0;
            border-color: #3a4556;
        }
        body.dark-mode .table td {
            color: #e0e0e0;
            border-color: #3a4556;
        }
        body.dark-mode .table tbody tr {
            border-color: #3a4556;
        }
        body.dark-mode .table tbody tr:hover td {
            background-color: #2d3748;
        }
        body.dark-mode .table {
            --bs-table-bg: #252d3a;
            --bs-table-hover-bg: #2d3748;
            --bs-table-border-color: #3a4556;
        }
        body.dark-mode .table tbody tr td {
            background-color: #252d3a;
        }
        body.dark-mode .table tbody tr:hover td {
            background-color: #2d3748;
        }

        /* Form Select */
        body.dark-mode .form-select {
            background-color: #2d3748;
            color: #e0e0e0;
            border-color: #3a4556;
            /* Replace Bootstrap's dark arrow SVG with a light one */
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23e0e0e0' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");
        }
        body.dark-mode .form-select option {
            background-color: #2d3748;
            color: #e0e0e0;
        }

        /* Interventions */
        body.dark-mode .intervention-item {
            background: #2d3748;
        }
        body.dark-mode .intervention-item .int-name {
            color: #e0e0e0;
        }
        body.dark-mode .intervention-item .int-meta {
            color: #8899a6;
        }
        body.dark-mode .intervention-item .int-detail {
            color: #e57373;
        }

        /* Footer */
        body.dark-mode .dashboard-footer {
            color: #5a6a7e;
        }

        /* Sidebar number (rightBarChart count) */
        body.dark-mode .section-body .fw-bold {
            color: #e0e0e0;
        }

        /* Theme Panel — dark overrides */
        body.dark-mode #themePanel {
            background: #252d3a;
            color: #e0e0e0;
            border-left-color: #3a4556;
        }
        body.dark-mode .tp-title,
        body.dark-mode .tp-label,
        body.dark-mode .tp-section-label,
        body.dark-mode .tp-font-label,
        body.dark-mode .tp-font-value {
            color: #e0e0e0;
        }
        body.dark-mode .tp-divider {
            border-color: #3a4556;
        }
        body.dark-mode .tp-btn {
            background: #3a4556 !important;
            color: #e0e0e0 !important;
        }
        body.dark-mode .tp-btn:hover {
            background: #4a5a6e !important;
        }
        body.dark-mode #themePanel input[type="range"] {
            background: #3a4556;
        }

        /* ════════════════════════════════════════
           DARK MODE + AGRI THEME COMBINATION
        ════════════════════════════════════════ */

        body.dark-mode[data-theme="agri"] {
            background-color: #0a1f10;
        }
        body.dark-mode[data-theme="agri"] .top-navbar {
            background-color: #071508;
        }
        body.dark-mode[data-theme="agri"] .navbar-hamburger,
        body.dark-mode[data-theme="agri"] .navbar-icon,
        body.dark-mode[data-theme="agri"] .top-navbar .nav-link {
            color: #e0e0e0 !important;
        }
        body.dark-mode[data-theme="agri"] .page-header h4 {
            color: #ffffff;
        }
        body.dark-mode[data-theme="agri"] .breadcrumb-item.active,
        body.dark-mode[data-theme="agri"] .breadcrumb-item + .breadcrumb-item::before {
            color: #8899a6;
        }
        body.dark-mode[data-theme="agri"] .stat-card {
            background: #1a3a1a;
            border-color: #2d5a2d;
            box-shadow: 0 3px 6px rgba(0,0,0,0.3);
        }
        body.dark-mode[data-theme="agri"] .stat-card .stat-info h6,
        body.dark-mode[data-theme="agri"] .stat-card .stat-info h3 {
            color: #ffffff;
        }
        body.dark-mode[data-theme="agri"] .stat-card .stat-info small,
        body.dark-mode[data-theme="agri"] .stat-card .stat-info .text-muted-sm {
            color: #a0c4a0;
        }
        body.dark-mode[data-theme="agri"] .section-card {
            background: #1a3a1a;
            border-color: #2d5a2d;
            box-shadow: 0 5px 6px rgba(0,0,0,0.3);
        }
        body.dark-mode[data-theme="agri"] .section-card .section-header {
            background-color: #1a3a1a;
            color: #e0e0e0;
            border-bottom-color: #2d5a2d;
        }
        body.dark-mode[data-theme="agri"] .reg-item {
            border-bottom-color: #2d5a2d;
        }
        body.dark-mode[data-theme="agri"] .reg-item .reg-name {
            color: #e0e0e0;
        }
        body.dark-mode[data-theme="agri"] .reg-item .reg-meta,
        body.dark-mode[data-theme="agri"] .reg-item .reg-date {
            color: #a0c4a0;
        }
        body.dark-mode[data-theme="agri"] .table th {
            background-color: #0f2410;
            color: #a0c4a0;
            border-color: #2d5a2d;
        }
        body.dark-mode[data-theme="agri"] .table td {
            background-color: #1a3a1a;
            color: #e0e0e0;
            border-color: #2d5a2d;
        }
        body.dark-mode[data-theme="agri"] .table tbody tr:hover td {
            background-color: #224d22;
        }
        body.dark-mode[data-theme="agri"] .table {
            --bs-table-bg: #1a3a1a;
            --bs-table-hover-bg: #224d22;
            --bs-table-border-color: #2d5a2d;
        }
        body.dark-mode[data-theme="agri"] .intervention-item {
            background: #0f2410;
        }
        body.dark-mode[data-theme="agri"] .intervention-item .int-name {
            color: #e0e0e0;
        }
        body.dark-mode[data-theme="agri"] .intervention-item .int-meta {
            color: #a0c4a0;
        }
        body.dark-mode[data-theme="agri"] .form-select {
            background-color: #0f2410;
            color: #e0e0e0;
            border-color: #2d5a2d;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23e0e0e0' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");
        }
        body.dark-mode[data-theme="agri"] .dropdown-menu {
            background-color: #1a3a1a;
            border-color: #2d5a2d;
        }
        body.dark-mode[data-theme="agri"] .dropdown-item {
            color: #e0e0e0;
        }
        body.dark-mode[data-theme="agri"] .dropdown-item:hover {
            background-color: #224d22;
        }
        body.dark-mode[data-theme="agri"] .map-controls-panel {
            background: #1a3a1a;
            color: #e0e0e0;
        }
        body.dark-mode[data-theme="agri"] .map-controls-panel .form-check-label {
            color: #e0e0e0;
        }
        body.dark-mode[data-theme="agri"] .dashboard-footer {
            color: #a0c4a0;
        }
        body.dark-mode[data-theme="agri"] .reg-scrollable::-webkit-scrollbar-thumb {
            background: #2d5a2d;
        }
        body.dark-mode[data-theme="agri"] #themePanel {
            background: #1a3a1a;
            border-left-color: #2d5a2d;
        }
        body.dark-mode[data-theme="agri"] .tp-title,
        body.dark-mode[data-theme="agri"] .tp-label,
        body.dark-mode[data-theme="agri"] .tp-section-label,
        body.dark-mode[data-theme="agri"] .tp-font-label,
        body.dark-mode[data-theme="agri"] .tp-font-value {
            color: #e0e0e0;
        }
        body.dark-mode[data-theme="agri"] .tp-divider {
            border-color: #2d5a2d;
        }
        body.dark-mode[data-theme="agri"] .tp-btn {
            background: #2d5a2d !important;
            color: #e0e0e0 !important;
        }
        body.dark-mode[data-theme="agri"] .tp-btn:hover {
            background: #3a7a3a !important;
        }
        body.dark-mode[data-theme="agri"] #themePanel input[type="range"] {
            background: #2d5a2d;
        }

        /* ════════════════════════════════════════
           DARK MODE + OCEAN THEME COMBINATION
        ════════════════════════════════════════ */

        body.dark-mode[data-theme="ocean"] {
            background-color: #060f1a;
        }
        body.dark-mode[data-theme="ocean"] .top-navbar {
            background-color: #030912;
        }
        body.dark-mode[data-theme="ocean"] .navbar-hamburger,
        body.dark-mode[data-theme="ocean"] .navbar-icon,
        body.dark-mode[data-theme="ocean"] .top-navbar .nav-link {
            color: #e0e0e0 !important;
        }
        body.dark-mode[data-theme="ocean"] .page-header h4 {
            color: #ffffff;
        }
        body.dark-mode[data-theme="ocean"] .breadcrumb-item.active,
        body.dark-mode[data-theme="ocean"] .breadcrumb-item + .breadcrumb-item::before {
            color: #8899a6;
        }
        body.dark-mode[data-theme="ocean"] .stat-card {
            background: #0d1f35;
            border-color: #1a3a5c;
            box-shadow: 0 3px 6px rgba(0,0,0,0.3);
        }
        body.dark-mode[data-theme="ocean"] .stat-card .stat-info h6,
        body.dark-mode[data-theme="ocean"] .stat-card .stat-info h3 {
            color: #ffffff;
        }
        body.dark-mode[data-theme="ocean"] .stat-card .stat-info small,
        body.dark-mode[data-theme="ocean"] .stat-card .stat-info .text-muted-sm {
            color: #7ab8d4;
        }
        body.dark-mode[data-theme="ocean"] .section-card {
            background: #0d1f35;
            border-color: #1a3a5c;
            box-shadow: 0 5px 6px rgba(0,0,0,0.3);
        }
        body.dark-mode[data-theme="ocean"] .section-card .section-header {
            background-color: #0d1f35;
            color: #e0e0e0;
            border-bottom-color: #1a3a5c;
        }
        body.dark-mode[data-theme="ocean"] .reg-item {
            border-bottom-color: #1a3a5c;
        }
        body.dark-mode[data-theme="ocean"] .reg-item .reg-name {
            color: #e0e0e0;
        }
        body.dark-mode[data-theme="ocean"] .reg-item .reg-meta,
        body.dark-mode[data-theme="ocean"] .reg-item .reg-date {
            color: #7ab8d4;
        }
        body.dark-mode[data-theme="ocean"] .table th {
            background-color: #071526;
            color: #7ab8d4;
            border-color: #1a3a5c;
        }
        body.dark-mode[data-theme="ocean"] .table td {
            background-color: #0d1f35;
            color: #e0e0e0;
            border-color: #1a3a5c;
        }
        body.dark-mode[data-theme="ocean"] .table tbody tr:hover td {
            background-color: #152d4a;
        }
        body.dark-mode[data-theme="ocean"] .table {
            --bs-table-bg: #0d1f35;
            --bs-table-hover-bg: #152d4a;
            --bs-table-border-color: #1a3a5c;
        }
        body.dark-mode[data-theme="ocean"] .intervention-item {
            background: #071526;
        }
        body.dark-mode[data-theme="ocean"] .intervention-item .int-name {
            color: #e0e0e0;
        }
        body.dark-mode[data-theme="ocean"] .intervention-item .int-meta {
            color: #7ab8d4;
        }
        body.dark-mode[data-theme="ocean"] .form-select {
            background-color: #071526;
            color: #e0e0e0;
            border-color: #1a3a5c;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23e0e0e0' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");
        }
        body.dark-mode[data-theme="ocean"] .dropdown-menu {
            background-color: #0d1f35;
            border-color: #1a3a5c;
        }
        body.dark-mode[data-theme="ocean"] .dropdown-item {
            color: #e0e0e0;
        }
        body.dark-mode[data-theme="ocean"] .dropdown-item:hover {
            background-color: #152d4a;
        }
        body.dark-mode[data-theme="ocean"] .map-controls-panel {
            background: #0d1f35;
            color: #e0e0e0;
        }
        body.dark-mode[data-theme="ocean"] .map-controls-panel .form-check-label {
            color: #e0e0e0;
        }
        body.dark-mode[data-theme="ocean"] .dashboard-footer {
            color: #7ab8d4;
        }
        body.dark-mode[data-theme="ocean"] .reg-scrollable::-webkit-scrollbar-thumb {
            background: #1a3a5c;
        }
        body.dark-mode[data-theme="ocean"] #themePanel {
            background: #0d1f35;
            border-left-color: #1a3a5c;
        }
        body.dark-mode[data-theme="ocean"] .tp-title,
        body.dark-mode[data-theme="ocean"] .tp-label,
        body.dark-mode[data-theme="ocean"] .tp-section-label,
        body.dark-mode[data-theme="ocean"] .tp-font-label,
        body.dark-mode[data-theme="ocean"] .tp-font-value {
            color: #e0e0e0;
        }
        body.dark-mode[data-theme="ocean"] .tp-divider {
            border-color: #1a3a5c;
        }
        body.dark-mode[data-theme="ocean"] .tp-btn {
            background: #1a3a5c !important;
            color: #e0e0e0 !important;
        }
        body.dark-mode[data-theme="ocean"] .tp-btn:hover {
            background: #1f4a75 !important; 
        }
        body.dark-mode[data-theme="ocean"] #themePanel input[type="range"] {
            background: #1a3a5c;
        }
    </style>
</head>
<body>
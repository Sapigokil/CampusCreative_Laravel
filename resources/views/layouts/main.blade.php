<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - Base CMS</title>
    <style>
        body { margin: 0; font-family: sans-serif; display: flex; height: 100vh; background-color: #f4f6f9; }
        
        /* Sidebar Styles */
        .sidebar { width: 250px; background-color: #343a40; color: white; display: flex; flex-direction: column; transition: all 0.3s ease; z-index: 1000; }
        .sidebar-header { padding: 20px; font-size: 20px; font-weight: bold; border-bottom: 1px solid #4f5962; display: flex; justify-content: space-between; align-items: center; }
        .sidebar a { color: #c2c7d0; text-decoration: none; padding: 15px 20px; display: block; border-bottom: 1px solid #4f5962;}
        .sidebar a:hover { background-color: #495057; color: white; }
        
        /* Main Area Styles */
        .main-wrapper { flex: 1; display: flex; flex-direction: column; overflow: hidden; width: 100%; }
        
        /* Navbar Styles */
        .navbar { background-color: white; padding: 15px 25px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); display: flex; justify-content: space-between; align-items: center; z-index: 10; }
        .nav-left { display: flex; align-items: center; gap: 15px; }
        .btn-logout { background: #dc3545; color: white; border: none; padding: 8px 15px; border-radius: 4px; cursor: pointer; }
        .btn-logout:hover { background: #c82333; }
        
        /* Content Styles */
        .content { flex: 1; padding: 25px; overflow-y: auto; }
        
        /* Footer Styles */
        .footer { background-color: white; padding: 15px 20px; text-align: center; border-top: 1px solid #ddd; font-size: 14px; color: #666; }

        /* Mobile & Collapsible Specific Styles */
        .btn-burger { background: none; border: none; font-size: 24px; cursor: pointer; display: none; padding: 0; color: #333; }
        .btn-close-sidebar { background: none; border: none; color: white; font-size: 28px; cursor: pointer; display: none; padding: 0; line-height: 1; }
        .sidebar-overlay { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 999; }

        /* Media Query untuk Mobile View */
        @media (max-width: 768px) {
            .sidebar { position: fixed; left: -250px; height: 100%; }
            .sidebar.active { left: 0; }
            .btn-burger { display: block; }
            .btn-close-sidebar { display: block; }
            .sidebar-overlay.active { display: block; }
            .content { padding: 15px; }
            .nav-left strong { font-size: 14px; }
        }
    </style>
    @stack('styles')
</head>
<body>

    <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

    @include('layouts.partials.sidebar')

    <div class="main-wrapper">
        @include('layouts.partials.navbar')

        <div class="content">
            @yield('content')
        </div>

        @include('layouts.partials.footer')
    </div>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('active');
            document.getElementById('sidebarOverlay').classList.toggle('active');
        }
    </script>
    
    @stack('scripts')
</body>
</html>
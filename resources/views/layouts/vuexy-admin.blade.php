<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="/assets/" data-template="vertical-menu-template-free">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>@yield('title', 'Admin Panel') - Vuexy</title>
    <meta name="description" content="" />
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo/assets/img/favicon/favicon.ico" />
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- Vuexy CSS -->
    <link rel="stylesheet" href="{{ asset('css/vuexy.css') }}">
    
    <style>
        /* Updated Sidebar Styles */
        .layout-menu {
            background: #fff !important;
            border-right: 1px solid #e7e7e7;
        }
        
        .sidebar-logo {
            padding: 1.5rem;
            text-align: center;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .sidebar-logo-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #dc3545 0%, #b02a37 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 0.5rem;
        }
        
        .sidebar-logo-icon span {
            color: white;
            font-weight: 700;
            font-size: 1.5rem;
        }
        
        .sidebar-logo-text {
            color: #dc3545;
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        .menu-inner {
            padding: 1rem 0.75rem !important;
        }
        
        .menu-item {
            margin: 0.25rem 0 !important;
        }
        
        .menu-link {
            display: flex;
            align-items: center;
            padding: 0.875rem 1rem !important;
            color: #6c757d !important;
            text-decoration: none;
            border-radius: 8px !important;
            border: 1px solid #e7e7e7;
            background: white !important;
            transition: all 0.2s;
        }
        
        .menu-link:hover {
            background: #f8f9fa !important;
            color: #2c3e50 !important;
            border-color: #dc3545;
        }
        
        .menu-item.active .menu-link {
            background: #dc3545 !important;
            color: white !important;
            border-color: #dc3545 !important;
        }
        
        .menu-icon {
            margin-right: 0.75rem;
            font-size: 1.125rem;
            width: 20px;
            text-align: center;
        }
        
        .menu-text {
            font-size: 0.875rem;
            font-weight: 500;
        }
        
        /* Navbar user section */
        .user-info-section {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        
        .user-check-icon {
            color: #dc3545;
        }
        
        .user-name {
            color: #6c757d;
            font-size: 0.875rem;
        }
        
        .user-avatar-circle {
            width: 36px;
            height: 36px;
            background: #f0f0f0;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        
        .user-avatar-circle img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
    
    @stack('styles')

</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <aside id="layout-menu" class="layout-menu menu-vertical menu">
                <!-- Logo -->
                <div class="sidebar-logo">
                    <div class="sidebar-logo-icon">
                        <span>KOI</span>
                    </div>
                    <div class="sidebar-logo-text">Konflik Kepentingan</div>
                </div>

                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner">
                    <!-- Dashboard -->
                    <li class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <a href="#" class="menu-link">
                            <i class="menu-icon bi bi-house-door"></i>
                            <span class="menu-text">Dashboard</span>
                        </a>
                    </li>

                    <!-- Pelaporan -->
                    <li class="menu-item {{ request()->routeIs('admin.posts.*') ? 'active' : '' }}">
                        <a href="#" class="menu-link">
                            <i class="menu-icon bi bi-file-earmark-text"></i>
                            <span class="menu-text">Pelaporan</span>
                        </a>
                    </li>

                    <!-- Deklarasi -->
                    <li class="menu-item">
                        <a href="#" class="menu-link">
                            <i class="menu-icon bi bi-clipboard-check"></i>
                            <span class="menu-text">Deklarasi</span>
                        </a>
                    </li>

                    <!-- FAQ -->
                    <li class="menu-item {{ request()->routeIs('admin.faqs.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.faqs.index') }}" class="menu-link">
                            <i class="menu-icon bi bi-question-circle"></i>
                            <span class="menu-text">FAQ</span>
                        </a>
                    </li>
                </ul>
            </aside>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar" style="box-shadow: 0 2px 6px rgba(0,0,0,0.05);">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bi bi-list" style="font-size: 1.5rem;"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-end w-100" id="navbar-collapse">
                        <div class="navbar-nav align-items-end flex-grow-1">
                            <!-- Empty space for alignment -->
                        </div>

                        <ul class="navbar-nav flex-row align-items-end ms-auto width-auto">
                            <!-- User Info -->
                            <li class="nav-item">
                                <div class="user-info-section">
                                    <i class="bi bi-check-circle-fill user-check-icon"></i>
                                    <span class="user-name">Deni Hidayat</span>
                                    <div class="user-avatar-circle">
                                        <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=f0f0f0&color=6c757d" alt="Avatar" />
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @yield('content')
                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    <footer class="content-footer footer bg-footer-theme">
                        <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                            <div class="mb-2 mb-md-0">
                                © {{ date('Y') }}, made with ❤️ by <strong>Blog App</strong>
                            </div>
                        </div>
                    </footer>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Simple JS for menu toggle and dropdown -->
    <script>
        // Menu toggle for mobile
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.querySelector('.layout-menu-toggle');
            const layoutMenu = document.querySelector('.layout-menu');
            const layoutOverlay = document.querySelector('.layout-overlay');
            
            if (menuToggle) {
                menuToggle.addEventListener('click', function() {
                    layoutMenu.classList.toggle('show');
                    layoutOverlay.classList.toggle('show');
                });
            }
            
            if (layoutOverlay) {
                layoutOverlay.addEventListener('click', function() {
                    layoutMenu.classList.remove('show');
                    layoutOverlay.classList.remove('show');
                });
            }
            
            // Dropdown toggle
            const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
            dropdownToggles.forEach(function(toggle) {
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    const dropdown = this.nextElementSibling;
                    if (dropdown && dropdown.classList.contains('dropdown-menu')) {
                        dropdown.classList.toggle('show');
                    }
                });
            });
            
            // Close dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if (!e.target.closest('.dropdown')) {
                    document.querySelectorAll('.dropdown-menu.show').forEach(function(menu) {
                        menu.classList.remove('show');
                    });
                }
            });
            
            // Alert close button
            const alertCloses = document.querySelectorAll('.btn-close');
            alertCloses.forEach(function(btn) {
                btn.addEventListener('click', function() {
                    this.closest('.alert').remove();
                });
            });
        });
    </script>

    @stack('scripts')
</body>
</html>

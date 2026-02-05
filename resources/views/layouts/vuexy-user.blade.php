<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="/assets/" data-template="vertical-menu-template-free">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>@yield('title', 'User Panel') - Vuexy</title>
    <meta name="description" content="" />
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo/assets/img/favicon/favicon.ico" />
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- Vuexy CSS -->
    <link rel="stylesheet" href="{{ asset('css/vuexy.css') }}">
    
    <style>
        .layout-menu {
            background: linear-gradient(135deg, #28c76f 0%, #1e9f5a 100%) !important;
        }
    </style>
    
    @stack('styles')

</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="{{ route('user.dashboard') }}" class="app-brand-link">
                        <span class="app-brand-logo demo">
                            <i class="bi bi-person-circle" style="font-size: 2rem; color: #fff;"></i>
                        </span>
                        <span class="app-brand-text demo menu-text fw-bolder ms-2">User Panel</span>
                    </a>

                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bi bi-x align-middle" style="color: #fff;"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1">
                    <!-- Dashboard -->
                    <li class="menu-item {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                        <a href="{{ route('user.dashboard') }}" class="menu-link">
                            <i class="menu-icon bi bi-house-door"></i>
                            <div data-i18n="Dashboard">Dashboard</div>
                        </a>
                    </li>

                    <!-- My Posts -->
                    <li class="menu-item {{ request()->routeIs('user.posts.index') ? 'active' : '' }}">
                        <a href="{{ route('user.posts.index') }}" class="menu-link">
                            <i class="menu-icon bi bi-newspaper"></i>
                            <div data-i18n="Posts">My Posts</div>
                        </a>
                    </li>

                    <!-- Create Post -->
                    <li class="menu-item {{ request()->routeIs('user.posts.create') ? 'active' : '' }}">
                        <a href="{{ route('user.posts.create') }}" class="menu-link">
                            <i class="menu-icon bi bi-plus-circle"></i>
                            <div data-i18n="Create">Create Post</div>
                        </a>
                    </li>

                    <!-- FAQs -->
                    <li class="menu-item {{ request()->routeIs('user.faqs.*') ? 'active' : '' }}">
                        <a href="{{ route('user.faqs.index') }}" class="menu-link">
                            <i class="menu-icon bi bi-question-circle"></i>
                            <div data-i18n="FAQs">FAQ</div>
                        </a>
                    </li>

                    <!-- Divider -->
                    <li class="menu-header small text-uppercase" style="color: rgba(255,255,255,0.6);">
                        <span class="menu-header-text">Other</span>
                    </li>

                    <!-- View Website -->
                    <li class="menu-item">
                        <a href="{{ route('home') }}" target="_blank" class="menu-link">
                            <i class="menu-icon bi bi-box-arrow-up-right"></i>
                            <div data-i18n="Website">View Website</div>
                        </a>
                    </li>
                </ul>
            </aside>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bi bi-list" style="font-size: 1.5rem;"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <div class="navbar-nav align-items-center">
                            <div class="nav-item d-flex align-items-center">
                                <h5 class="mb-0">@yield('page-title', 'Dashboard')</h5>
                            </div>
                        </div>

                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <!-- User -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=28c76f&color=fff" alt class="w-px-40 h-auto rounded-circle" />
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                        <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=28c76f&color=fff" alt class="w-px-40 h-auto rounded-circle" />
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <span class="fw-semibold d-block">{{ auth()->user()->name }}</span>
                                                    <small class="text-muted">Member since {{ auth()->user()->created_at->format('M Y') }}</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item">
                                                <i class="bi bi-box-arrow-right me-2"></i>
                                                <span class="align-middle">Log Out</span>
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                            <!--/ User -->
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
            
            // Accordion functionality
            const accordionButtons = document.querySelectorAll('.accordion-button');
            accordionButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    const target = this.getAttribute('data-bs-target');
                    const collapse = document.querySelector(target);
                    
                    if (collapse) {
                        const isExpanded = this.getAttribute('aria-expanded') === 'true';
                        
                        // Close all other accordions in the same parent
                        const parent = this.closest('.accordion');
                        if (parent) {
                            parent.querySelectorAll('.accordion-collapse.show').forEach(function(item) {
                                if (item !== collapse) {
                                    item.classList.remove('show');
                                    const btn = document.querySelector('[data-bs-target="#' + item.id + '"]');
                                    if (btn) {
                                        btn.classList.add('collapsed');
                                        btn.setAttribute('aria-expanded', 'false');
                                    }
                                }
                            });
                        }
                        
                        // Toggle current accordion
                        if (isExpanded) {
                            collapse.classList.remove('show');
                            this.classList.add('collapsed');
                            this.setAttribute('aria-expanded', 'false');
                        } else {
                            collapse.classList.add('show');
                            this.classList.remove('collapsed');
                            this.setAttribute('aria-expanded', 'true');
                        }
                    }
                });
            });
        });
    </script>

    @stack('scripts')
</body>
</html>

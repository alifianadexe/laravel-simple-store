<!DOCTYPE html>

<html
    lang="en"
    class="light-style layout-navbar-fixed layout-menu-fixed"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="{{asset('/')}}assets/"
    data-template="vertical-menu-template-no-customizer-starter"
>
<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Stride Style - Admin Panel</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('/') }}assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet"
    />

    <!-- Icons -->
    <link rel="stylesheet" href="{{asset('/')}}assets/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="{{asset('/')}}assets/vendor/fonts/tabler-icons.css" />
    <link rel="stylesheet" href="{{asset('/')}}assets/vendor/fonts/flag-icons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{asset('/')}}assets/vendor/css/rtl/core.css" />
    <link rel="stylesheet" href="{{asset('/')}}assets/vendor/css/rtl/theme-default.css" />
    <link rel="stylesheet" href="{{asset('/')}}assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{asset('/')}}assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="{{asset('/')}}assets/vendor/libs/node-waves/node-waves.css" />

    <link rel="stylesheet" href="{{asset('/')}}assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
    <link rel="stylesheet" href="{{asset('/')}}assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />
    <link rel="stylesheet" href="{{asset('/')}}assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css" />
    <link rel="stylesheet" href="{{asset('/')}}assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css" />
    <link rel="stylesheet" href="{{asset('/')}}assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{asset('/')}}assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{asset('/')}}assets/js/config.js"></script>
</head>

<body>
<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
            <div class="app-brand demo">
                <a href="#" class="app-brand-link">
              <span class="app-brand-logo demo" style="width: calc(100% - 1rem); height: auto;">
                  <img src="{{asset('logo.svg')}}" alt="logo" style="width: 100%;">
              </span>
{{--                    <span class="app-brand-text demo menu-text fw-bold">{{config('app.name')}}</span>--}}
                </a>

                <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
                    <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
                    <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
                </a>
            </div>

            <div class="menu-inner-shadow"></div>

            <ul class="menu-inner py-1">
                <!-- Page -->
                <li class="menu-item {{explode('.', request()->route()->getName())[1] == 'dashboard' ? 'active' : ''}}">
                    <a href="{{route('admin.dashboard')}}" class="menu-link">
                        <i class="menu-icon tf-icons ti ti-home"></i>
                        <div data-i18n="Page 1">Dashboard</div>
                    </a>
                </li>
                <li class="menu-header">Main Menu</li>
                <li class="menu-item {{explode('.', request()->route()->getName())[1] == 'transactions' ? 'active' : ''}}">
                    <a href="{{route('admin.transactions.index')}}" class="menu-link">
                        <i class="menu-icon tf-icons ti ti-notes"></i>
                        <div data-i18n="Page 2">Transactions</div>
                    </a>
                </li>

                @if(auth()->user()->role_id == 4)
                    <li class="menu-item {{explode('.', request()->route()->getName())[1] == 'report' ? 'active' : ''}}">
                        <a href="{{route('admin.report')}}" class="menu-link">
                            <i class="menu-icon tf-icons ti ti-chart-bar"></i>
                            <div data-i18n="Page 2">Report</div>
                        </a>
                    </li>
                @endif
                
                <li class="menu-header">Master Data</li>
                {{-- <li class="menu-item {{explode('.', request()->route()->getName())[1] == 'products' ? 'active' : ''}}">
                    <a href="{{route('admin.products.index')}}" class="menu-link">
                        <i class="menu-icon tf-icons ti ti-box"></i>
                        <div data-i18n="Page 2">Products</div>
                    </a>
                </li> --}}
                <li class="menu-item {{explode('.', request()->route()->getName())[1] == 'serialnumber' ? 'active' : ''}}">
                    <a href="{{route('admin.serialnumber.index')}}" class="menu-link">
                        <i class="menu-icon tf-icons ti ti-box"></i>
                        <div data-i18n="Page 2">Serial Number</div>
                    </a>
                </li>
                {{-- <li class="menu-item {{explode('.', request()->route()->getName())[1] == 'categories' ? 'active' : ''}}">
                    <a href="{{route('admin.categories.index')}}" class="menu-link">
                        <i class="menu-icon tf-icons ti ti-category"></i>
                        <div data-i18n="Page 2">Categories</div>
                    </a>
                </li> --}}
                <li class="menu-item {{explode('.', request()->route()->getName())[1] == 'barang' ? 'active' : ''}}">
                    <a href="{{route('admin.barang.index')}}" class="menu-link">
                        <i class="menu-icon tf-icons ti ti-shoe"></i>
                        <div data-i18n="Page 2">Barang</div>
                    </a>
                </li>
                {{-- <li class="menu-item {{explode('.', request()->route()->getName())[1] == 'customers' ? 'active' : ''}}">
                    <a href="{{route('admin.customers.index')}}" class="menu-link">
                        <i class="menu-icon tf-icons ti ti-user-plus"></i>
                        <div data-i18n="Page 2">Customers</div>
                    </a>
                </li> --}}
                @if(auth()->user()->role_id == 1)
                {{-- <li class="menu-item {{explode('.', request()->route()->getName())[1] == 'users' ? 'active' : ''}}">
                    <a href="{{route('admin.users.index')}}" class="menu-link">
                        <i class="menu-icon tf-icons ti ti-users"></i>
                        <div data-i18n="Page 2">Users</div>
                    </a>
                </li> --}}
                @endif
            </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
            <!-- Navbar -->

            <nav
                class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                id="layout-navbar"
            >
                <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                    <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                        <i class="ti ti-menu-2 ti-sm"></i>
                    </a>
                </div>

                <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                    <div class="navbar-nav align-items-center">
                        <a class="nav-link style-switcher-toggle hide-arrow" href="javascript:void(0);">
                            <i class="ti ti-sm"></i>
                        </a>
                    </div>

                    <ul class="navbar-nav flex-row align-items-center ms-auto">
                        <!-- User -->
                        <li class="nav-item navbar-dropdown dropdown-user dropdown">
                            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                                <div class="avatar avatar-online">
                                    <span class="avatar-initial rounded-circle bg-label-primary">
                                        {{ collect(explode(' ', auth()->user()->name))->map(fn($str) => $str[0])->join('') }}
                                    </span>
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar avatar-online">
                                                    <span class="avatar-initial rounded-circle bg-label-primary">
                                                        {{ collect(explode(' ', auth()->user()->name))->map(fn($str) => $str[0])->join('') }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <span class="fw-semibold d-block">
                                                    {{auth()->user()->name}}
                                                </span>
                                                <small class="text-muted">
                                                    {{auth()->user()->role->name}}
                                                </small>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <div class="dropdown-divider"></div>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('form-logout').submit()">
                                        <i class="ti ti-logout me-2 ti-sm"></i>
                                        <span class="align-middle">Log Out</span>
                                    </a>
                                    <form action="{{route('logout')}}" method="POST" id="form-logout">
                                        @csrf
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
                @yield('content')
                <!-- / Content -->

                <!-- Footer -->
                <footer class="content-footer footer bg-footer-theme">
                    <div class="container-xxl">
                        <div
                            class="footer-container d-flex align-items-center justify-content-between py-2 flex-md-row flex-column"
                        >
                            <div>
                                ©
                                <script>
                                    document.write(new Date().getFullYear());
                                </script>
                                , made with ❤️ by Team Assignment - Group 3
                            </div>
                            <div>
                                <a
                                    href="https://pixinvent.com/demo/vuexy-html-bootstrap-admin-template/documentation/"
                                    target="_blank"
                                    class="footer-link me-4"
                                >Documentation</a
                                >
                            </div>
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

    <!-- Drag Target Area To SlideIn Menu On Small Screens -->
    <div class="drag-target"></div>
</div>
<!-- / Layout wrapper -->

<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="{{asset('/')}}assets/vendor/libs/jquery/jquery.js"></script>
<script src="{{asset('/')}}assets/vendor/libs/popper/popper.js"></script>
<script src="{{asset('/')}}assets/vendor/js/bootstrap.js"></script>
<script src="{{asset('/')}}assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="{{asset('/')}}assets/vendor/libs/node-waves/node-waves.js"></script>

<script src="{{asset('/')}}assets/vendor/libs/hammer/hammer.js"></script>

<script src="{{asset('/')}}assets/vendor/js/menu.js"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<script src="{{asset('/')}}assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
<script src="{{asset('/')}}assets/vendor/libs/apex-charts/apexcharts.js"></script>

<!-- Main JS -->
<script src="{{asset('/')}}assets/js/main.js"></script>

<!-- Page JS -->
<script src="{{asset('/')}}assets/js/tables-datatables-basic.js"></script>
@yield('js')
</body>
</html>

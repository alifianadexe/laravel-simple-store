<!DOCTYPE html>

<html
    lang="en"
    class="light-style layout-menu-fixed"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="{{ asset('/') }}assets/"
    data-template="horizontal-menu-template-no-customizer-starter"
>
<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>{{config('app.name')}}</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('/') }}assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet"
    />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('/') }}assets/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="{{ asset('/') }}assets/vendor/fonts/tabler-icons.css" />
    <link rel="stylesheet" href="{{ asset('/') }}assets/vendor/fonts/flag-icons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('/') }}assets/vendor/css/rtl/core.css" />
    <link rel="stylesheet" href="{{ asset('/') }}assets/vendor/css/rtl/theme-default.css" />
    <link rel="stylesheet" href="{{ asset('/') }}assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('/') }}assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="{{ asset('/') }}assets/vendor/libs/node-waves/node-waves.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('/') }}assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('/') }}assets/js/config.js"></script>
    <style>
        * {
            font-family: "Open Sans",  "Segoe UI", "Roboto", "Helvetica Neue", Arial, sans-serif;
        }
    </style>
</head>

<body>
<!-- Layout wrapper -->
<div class="layout-wrapper layout-navbar-full layout-horizontal layout-without-menu">
    <div class="layout-container">
        <!-- Navbar -->

        <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
            <div class="container-xxl">
                <div class="navbar-brand app-brand demo d-none d-xl-flex py-0 me-4">
                    <a href="{{route('home')}}" class="app-brand-link gap-2">
                <span class="app-brand-logo demo" style="width: auto; height: auto;">
                  <img src="{{asset('logo.svg')}}" alt="logo" style="height: 35px;">
                </span>
{{--                        <span class="app-brand-text demo menu-text fw-bold">{{config('app.name')}}</span>--}}
                    </a>

                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-xl-none">
                        <i class="ti ti-x ti-sm align-middle"></i>
                    </a>
                </div>

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
                        <li class="nav-item">
                            <a href="{{route('cart')}}" class="nav-link me-4">
                                <button type="button" class="btn text-nowrap d-inline-block">
                                    <span class="tf-icons ti-sm ti ti-shopping-cart"></span>
                                    <span class="badge bg-primary text-white badge-notifications" id="cart">
                                        {{$cart->reduce(fn($carry, $item) => $carry+=$item, 0)}}
                                    </span>
                                </button>
                            </a>
                        </li>

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
                                    <a class="dropdown-item" href="{{route('transactions')}}">
                                        <i class="ti ti-notes me-2 ti-sm"></i>
                                        <span class="align-middle">Transactions</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="ti ti-heart me-2 ti-sm"></i>
                                        <span class="align-middle">My Wishlist</span>
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
                    </ul>
                </div>
            </div>
        </nav>

        <!-- / Navbar -->

        <!-- Layout container -->
        <div class="layout-page">
            <!-- Content wrapper -->
            <div class="content-wrapper">
                <!-- Menu -->
                <aside id="layout-menu" class="layout-menu-horizontal menu-horizontal menu bg-menu-theme flex-grow-0">
                    <div class="container-xxl d-flex h-100">
                        <ul class="menu-inner py-1">
                            <!-- Page -->

                            <li class="menu-item {{request()->path() == '/' ? 'active' : ''}}">
                                <a href="{{route('home')}}" class="menu-link">
                                    New and Featured
                                </a>
                            </li>

                            @foreach(\App\Models\ProductCategory::where('parent_id', null)->get() as $category)
                            @include('layouts.menu-item', ['category' => $category])
                            @endforeach

                            <li class="menu-item">
                                <a href="" class="menu-link menu-toggle">
                                    <div data-i18n="Page 1">All Brands</div>
                                </a>

                                <ul class="menu-sub">
                                    @foreach(\App\Models\ProductBrand::orderBy('name')->get() as $brand)
                                        <li class="menu-item">
                                            <a href="{{route('brand', [$brand->slug])}}" class="menu-link d-flex align-items-center">
                                                <img src="{{$brand->logo}}" alt="{{$brand->name}}" style="width: 25px;" class="me-2"> <div>{{$brand->name}}</div>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>

                            </li>

                        </ul>
                    </div>
                </aside>
                <!-- / Menu -->

                <!-- Content -->
                @yield('content')
                <!--/ Content -->

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
                                , made with ❤️ by Team 6
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- / Footer -->

                <div class="content-backdrop fade"></div>
            </div>
            <!--/ Content wrapper -->
        </div>

        <!--/ Layout container -->
    </div>
</div>

<!-- Overlay -->
<div class="layout-overlay layout-menu-toggle"></div>

<!-- Drag Target Area To SlideIn Menu On Small Screens -->
<div class="drag-target"></div>

<div class="modal" id="cart-modal" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Success</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Product successfully added to cart
            </div>
            <div class="modal-footer">
                <a href="{{route('cart')}}" class="btn w-100 btn-primary waves-effect waves-light">View Cart</a>
            </div>
        </div>
    </div>
</div>

<!--/ Layout wrapper -->

<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="{{ asset('/') }}assets/vendor/libs/jquery/jquery.js"></script>
<script src="{{ asset('/') }}assets/vendor/libs/popper/popper.js"></script>
<script src="{{ asset('/') }}assets/vendor/js/bootstrap.js"></script>
<script src="{{ asset('/') }}assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="{{ asset('/') }}assets/vendor/libs/node-waves/node-waves.js"></script>

<script src="{{ asset('/') }}assets/vendor/libs/hammer/hammer.js"></script>

<script src="{{ asset('/') }}assets/vendor/js/menu.js"></script>
<!-- endbuild -->

<!-- Vendors JS -->

<!-- Main JS -->
<script src="{{ asset('/') }}assets/js/main.js"></script>

<script>
    $('body').delegate('.add-to-cart', 'click', function(e) {
        e.preventDefault()

        $.ajax({
            url: '{{route('cart')}}',
            method: 'POST',
            data: {
                _token: '{{csrf_token()}}',
                product_id: $(this).data('id'),
            },
            success: function(response) {
                $('#cart-modal').modal('show')
                $('#cart').text(response.total_cart);
            }
        })
    })
</script>

<!-- Page JS -->
</body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{ asset('../../../../global_assets/css/icons/icomoon/styles.min.css') }}" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('assets/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script src="{{ asset('../../../../global_assets/js/main/jquery.min.js') }}"></script>
    <script src="{{ asset('../../../../global_assets/js/main/bootstrap.bundle.min.js') }}"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script src="{{ asset('../../../../global_assets/js/plugins/visualization/d3/d3.min.js') }}"></script>
    <script src="{{ asset('../../../../global_assets/js/plugins/visualization/d3/d3_tooltip.js') }}"></script>
    <script src="{{ asset('../../../../global_assets/js/plugins/ui/moment/moment.min.js') }}"></script>
    <script src="{{ asset('../../../../global_assets/js/plugins/pickers/daterangepicker.js') }}"></script>

    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('../../../../global_assets/js/demo_pages/dashboard.js') }}"></script>
    <script src="{{ asset('../../../../global_assets/js/demo_charts/pages/dashboard/dark/streamgraph.js') }}"></script>
    <script src="{{ asset('../../../../global_assets/js/demo_charts/pages/dashboard/dark/sparklines.js') }}"></script>
    <script src="{{ asset('../../../../global_assets/js/demo_charts/pages/dashboard/dark/lines.js') }}"></script>
    <script src="{{ asset('../../../../global_assets/js/demo_charts/pages/dashboard/dark/areas.js') }}"></script>
    <script src="{{ asset('../../../../global_assets/js/demo_charts/pages/dashboard/dark/donuts.js') }}"></script>
    <script src="{{ asset('../../../../global_assets/js/demo_charts/pages/dashboard/dark/bars.js') }}"></script>
    <script src="{{ asset('../../../../global_assets/js/demo_charts/pages/dashboard/dark/progress.js') }}"></script>
    <script src="{{ asset('../../../../global_assets/js/demo_charts/pages/dashboard/dark/heatmaps.js') }}"></script>
    <script src="{{ asset('../../../../global_assets/js/demo_charts/pages/dashboard/dark/pies.js') }}"></script>
    <script src="{{ asset('../../../../global_assets/js/demo_charts/pages/dashboard/dark/bullets.js') }}"></script>
    <!-- /theme JS files -->

    {{-- Table --}}

    <!-- Theme JS files -->
    <script src="{{ asset('../../../../global_assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('../../../../global_assets/js/demo_pages/datatables_advanced.js') }}"></script>

    <!-- Theme JS files -->
    <script src="{{ asset('../../../../global_assets/js/plugins/extensions/jquery_ui/interactions.min.js') }}"></script>
    <script src="{{ asset('../../../../global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>
    <script src="{{ asset('../../../../global_assets/js/demo_pages/form_select2.js') }}"></script>
    <!-- /theme JS files -->

    <!-- Form input file -->
    <!-- Theme JS files -->
    <script src="{{ asset('../../../../global_assets/js/plugins/uploaders/bs_custom_file_input.min.js') }}"></script>
    <script src="{{ asset('../../../../global_assets/js/demo_pages/form_floating_labels.js') }}"></script>
    <!-- Form input file -->

    {{-- Select Multiple --}}
    <!-- Theme JS files -->
    <script src="{{ asset('global_assets/js/plugins/notifications/pnotify.min.js') }}"></script>
    <script src="{{ asset('global_assets/js/plugins/forms/selects/bootstrap_multiselect.js') }}"></script>

    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('global_assets/js/demo_pages/form_multiselect.js') }}"></script>
    {{-- Select Multiple --}}

</head>

<body>

    <!-- Main navbar -->
    <div class="navbar navbar-expand-lg navbar-light navbar-static">

        <div class="navbar-brand text-center text-lg-left">
            <a href="/user-list" class="d-inline-block">
                <img src="../../../../global_assets/images/logo_light.png" class="d-none d-sm-block" alt="">
                <img src="../../../../global_assets/images/logo_icon_light.png" class="d-sm-none" alt="">
            </a>
        </div>

        <div class="collapse navbar-collapse order-2 order-lg-1" id="navbar-mobile">

        </div>

        <ul class="navbar-nav flex-row order-1 order-lg-2 flex-1 flex-lg-0 justify-content-end align-items-center">


            <li class="nav-item nav-item-dropdown-lg dropdown dropdown-user h-100">
                <a href="#"
                    class="navbar-nav-link navbar-nav-link-toggler dropdown-toggle d-inline-flex align-items-center h-100"
                    data-toggle="dropdown">
                    {{-- <img src="../../../../global_assets/images/placeholders/placeholder.jpg" class="rounded-pill"
                        height="34" alt=""> --}}
                    <span class="d-none d-lg-inline-block ml-2">Victoria</span>
                </a>

                <div class="dropdown-menu dropdown-menu-right">
                    <a href="#" class="dropdown-item"><i class="icon-user-plus"></i> My profile</a>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="dropdown-item"><i class="icon-switch2"></i> Logout</button>
                    </form>
                </div>
            </li>
        </ul>
    </div>
    <!-- /main navbar -->


    <!-- Page content -->
    <div class="page-content">

        <!-- Main sidebar -->
        <div class="sidebar sidebar-light sidebar-main sidebar-expand-lg">

            <!-- Sidebar content -->
            <div class="sidebar-content">

                <!-- User menu -->
                <div class="sidebar-section sidebar-user my-1">
                    <div class="sidebar-section-body">
                        <div class="media">
                            <a href="/user-list" class="mr-3">
                                <img src="../../../../global_assets/images/placeholders/placeholder.jpg"
                                    class="rounded-circle" alt="">
                            </a>

                            <div class="media-body">
                                <div class="font-weight-semibold">{{ Auth::user()->name }}</div>
                                {{-- <div class="font-size-sm line-height-sm opacity-50">
                                    Senior developer
                                </div> --}}
                            </div>

                            <div class="ml-3 align-self-center">
                                <button type="button"
                                    class="btn btn-outline-light text-body border-transparent btn-icon rounded-pill btn-sm sidebar-control sidebar-main-resize d-none d-lg-inline-flex">
                                    <i class="icon-transmission"></i>
                                </button>

                                <button type="button"
                                    class="btn btn-outline-light text-body border-transparent btn-icon rounded-pill btn-sm sidebar-mobile-main-toggle d-lg-none">
                                    <i class="icon-cross2"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /user menu -->


                <!-- Main navigation -->
                <div class="sidebar-section">
                    <ul class="nav nav-sidebar" data-nav-type="accordion">

                        <!-- Main -->
                        <li class="nav-item-header">
                            <div class="text-uppercase font-size-xs line-height-xs">Main</div> <i class="icon-menu"
                                title="Main"></i>
                        </li>
                        <li class="nav-item">
                            <a href="/user-list" class="nav-link active">
                                <i class="icon-home4"></i>
                                <span>
                                    Dashboard
                                </span>
                            </a>
                        </li>
                        <li class="nav-item nav-item-submenu">
                            <a href="#" class="nav-link"><i class="icon-stack"></i> <span>Users</span></a>

                            <ul class="nav nav-group-sub" data-submenu-title="Starter kit">
                                <li class="nav-item"><a href="{{ route('user.list') }}" class="nav-link">Users</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item nav-item-submenu">
                            <a href="#" class="nav-link"><i class="icon-stack"></i> <span>Customers /
                                    mijozlar</span></a>

                            <ul class="nav nav-group-sub" data-submenu-title="Starter kit">
                                <li class="nav-item"><a href="{{ route('customer.list') }}"
                                        class="nav-link">Customers</a></li>
                            </ul>
                        </li>
                        @if (Auth::user()->hasRole('hr'))
                            <li class="nav-item nav-item-submenu">
                                <a href="#" class="nav-link"><i class="icon-stack"></i>
                                    <span>HR</span></a>

                                <ul class="nav nav-group-sub" data-submenu-title="Starter kit">

                                    <li class="nav-item"><a href="{{ route('equipment.list') }}"
                                            class="nav-link">Equipment / Uskuna</a></li>
                                    <li class="nav-item"><a href="{{ route('department.list') }}"
                                            class="nav-link">Department / Bo'lim</a></li>

                                    <li class="nav-item"><a href="{{ route('salarytype.list') }}"
                                            class="nav-link">Salary Types / Oylik </a></li>

                                    <li class="nav-item"><a href="{{ route('staf.list') }}" class="nav-link">Staff
                                            Sheet / Hodimlar</a></li>
                                    <li class="nav-item"><a href="{{ route('courier.list') }}"
                                            class="nav-link">Courier / Kuryer</a></li>
                                </ul>
                            </li>
                        @endif
                        @if (Auth::user()->hasRole('hr'))
                            <li class="nav-item nav-item-submenu">
                                <a href="#" class="nav-link"><i class="icon-stack"></i>
                                    <span>Bugalter</span></a>

                                <ul class="nav nav-group-sub" data-submenu-title="Starter kit">

                                    {{-- <li class="nav-item"><a href="{{ route('material_stoks.list') }}"
                                            class="nav-link">Material Stok</a>
                                    </li>
                                    <li class="nav-item"><a href="{{ route('nakladnoy.list') }}"
                                            class="nav-link">Nakladnoy</a>
                                    </li>
                                    <li class="nav-item"><a href="{{ route('prixod.list') }}"
                                            class="nav-link">Prihod /
                                            Maxsulot kirishi</a></li> --}}
                                    <li class="nav-item"><a href="{{ route('salary.list') }}" class="nav-link">
                                            Salary / Oylik</a></li>
                                </ul>
                            </li>
                        @endif
                        @if (Auth::user()->hasRole('sklad_manager'))
                            <li class="nav-item nav-item-submenu">
                                <a href="#" class="nav-link"><i class="icon-stack"></i>
                                    <span>Material Stoks</span></a>

                                <ul class="nav nav-group-sub" data-submenu-title="Starter kit">

                                    <li class="nav-item"><a href="{{ route('material_stoks.list') }}"
                                            class="nav-link">Material Stok</a>
                                    </li>
                                    <li class="nav-item"><a href="{{ route('nakladnoy.list') }}"
                                            class="nav-link">Nakladnoy</a>
                                    </li>
                                    <li class="nav-item"><a href="{{ route('prixod.list') }}"
                                            class="nav-link">Prihod /
                                            Maxsulot kirishi</a></li>
                                </ul>
                            </li>
                        @endif
                        @if (Auth::user()->hasRole('admin'))
                            <li class="nav-item nav-item-submenu">
                                <a href="#" class="nav-link"><i class="icon-stack"></i>
                                    <span>Product models</span></a>

                                <ul class="nav nav-group-sub" data-submenu-title="Starter kit">

                                    <li class="nav-item"><a href="{{ route('product_model.list') }}"
                                            class="nav-link">Product models</a></li>
                                </ul>
                            </li>
                        @endif

                        <!-- /page kits -->

                    </ul>
                </div>
                <!-- /main navigation -->

            </div>
            <!-- /sidebar content -->

        </div>
        <!-- /main sidebar -->


        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Inner content -->
            <div class="content-inner">

                <!-- Page header -->

                @yield('con')
                <!-- /content area -->


                <!-- Footer -->
                <div class="navbar navbar-expand-lg navbar-light">
                    <div class="text-center d-lg-none w-100">
                        <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse"
                            data-target="#navbar-footer">
                            <i class="icon-unfold mr-2"></i>
                            Footer
                        </button>
                    </div>

                    <div class="navbar-collapse collapse" id="navbar-footer">
                        <span class="navbar-text">
                            &copy; 2015 - 2018. <a href="#">Limitless Web App Kit</a> by <a
                                href="https://themeforest.net/user/Kopyov" target="_blank">Eugene Kopyov</a>
                        </span>

                        <ul class="navbar-nav ml-lg-auto">
                            <li class="nav-item"><a href="https://kopyov.ticksy.com/" class="navbar-nav-link"
                                    target="_blank"><i class="icon-lifebuoy mr-2"></i> Support</a></li>
                            <li class="nav-item"><a href="https://demo.interface.club/limitless/docs/"
                                    class="navbar-nav-link" target="_blank"><i class="icon-file-text2 mr-2"></i>
                                    Docs</a></li>
                            <li class="nav-item"><a
                                    href="https://themeforest.net/item/limitless-responsive-web-application-kit/13080328?ref=kopyov"
                                    class="navbar-nav-link font-weight-semibold"><span class="text-pink"><i
                                            class="icon-cart2 mr-2"></i> Purchase</span></a></li>
                        </ul>
                    </div>
                </div>
                <!-- /footer -->

            </div>
            <!-- /inner content -->

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

</body>

</html>

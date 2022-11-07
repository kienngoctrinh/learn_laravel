<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Hyper</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
    <meta content="Coderthemes" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- App css -->
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/app-creative.min.css') }}" rel="stylesheet" type="text/css" id="light-style">
</head>

<body class="" data-layout-config="{&quot;leftSideBarTheme&quot;:&quot;dark&quot;,&quot;layoutBoxed&quot;:false, &quot;leftSidebarCondensed&quot;:false, &quot;leftSidebarScrollable&quot;:false,&quot;darkMode&quot;:false, &quot;showRightSidebarOnStart&quot;: true}" data-leftbar-theme="dark">
    <!-- Begin page -->
    <div class="wrapper mm-active">
        <!-- ========== Left Sidebar Start ========== -->
        @include('layout.sidebar')
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">
                <!-- Topbar Start -->
                @include('layout.header')
                <!-- end Topbar -->

                <!-- Start Content-->
                <div class="container-fluid">
                    <div class="row">
                        @if ($errors->any())
                            <div class="col-12">
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                        <div class="col-12">
                            <div class="page-title-box">
                                @if(isset($title))
                                    <h4 class="page-title">{{ $title }}</h4>
                                @endif
                            </div>
                        </div>
                            @if (session()->has('success'))
                                <div class="col-12">
                                    <div class="alert alert-success">
                                        {{ session()->get('success') }}
                                    </div>
                                </div>
                            @endif
                            @if (session()->has('error'))
                                <div class="col-12">
                                    <div class="alert alert-danger">
                                        {{ session()->get('error') }}
                                    </div>
                                </div>
                            @endif
                    </div>
                    <div class="row">
                        <div class="col-12">
                            @yield('content')
                        </div>
                    </div>

                </div>
                <!-- container -->

            </div>
            <!-- content -->

            <!-- Footer Start -->
            @include('layout.footer')
            <!-- end Footer -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->


    </div>
    <!-- END wrapper -->

    <!-- Right Sidebar -->
    <div class="right-bar">

        <div class="rightbar-title">
            <a href="javascript:void(0);" class="right-bar-toggle float-right">
                <i class="dripicons-cross noti-icon"></i>
            </a>
            <h5 class="m-0">Settings</h5>
        </div>

        <div class="rightbar-content h-100" data-simplebar="init">
            <div class="simplebar-wrapper" style="margin: 0px;">
                <div class="simplebar-height-auto-observer-wrapper">
                    <div class="simplebar-height-auto-observer"></div>
                </div>
                <div class="simplebar-mask">
                    <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                        <div class="simplebar-content-wrapper" style="height: 100%; overflow: hidden;">
                            <div class="simplebar-content" style="padding: 0px;">

                                <div class="p-3">
                                    <div class="alert alert-warning" role="alert">
                                        <strong>Customize </strong> the overall color scheme, layout width, etc.
                                    </div>

                                    <!-- Settings -->
                                    <h5 class="mt-3">Color Scheme</h5>
                                    <hr class="mt-1">

                                    <div class="custom-control custom-switch mb-1">
                                        <input type="radio" class="custom-control-input" name="color-scheme-mode" value="light" id="light-mode-check" checked="">
                                        <label class="custom-control-label" for="light-mode-check">Light Mode</label>
                                    </div>

                                    <div class="custom-control custom-switch mb-1">
                                        <input type="radio" class="custom-control-input" name="color-scheme-mode" value="dark" id="dark-mode-check">
                                        <label class="custom-control-label" for="dark-mode-check">Dark Mode</label>
                                    </div>

                                    <!-- Width -->
                                    <h5 class="mt-4">Width</h5>
                                    <hr class="mt-1">
                                    <div class="custom-control custom-switch mb-1">
                                        <input type="radio" class="custom-control-input" name="width" value="fluid" id="fluid-check" checked="">
                                        <label class="custom-control-label" for="fluid-check">Fluid</label>
                                    </div>
                                    <div class="custom-control custom-switch mb-1">
                                        <input type="radio" class="custom-control-input" name="width" value="boxed" id="boxed-check">
                                        <label class="custom-control-label" for="boxed-check">Boxed</label>
                                    </div>


                                    <button class="btn btn-primary btn-block mt-4" id="resetBtn">Reset to Default</button>

                                    <a href="https://themes.getbootstrap.com/product/hyper-responsive-admin-dashboard-template/" class="btn btn-danger btn-block mt-3" target="_blank"><i class="mdi mdi-basket mr-1"></i> Purchase Now</a>
                                </div> <!-- end padding-->

                            </div>
                        </div>
                    </div>
                </div>
                <div class="simplebar-placeholder" style="width: auto; height: 499px;"></div>
            </div>
            <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
            </div>
            <div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
                <div class="simplebar-scrollbar" style="height: 0px; display: none;"></div>
            </div>
        </div>
    </div>

    <div class="rightbar-overlay"></div>
    <!-- /Right-bar -->

    <!-- bundle -->
    <script src="{{ asset('js/vendor.min.js') }}"></script>
    <script src="{{ asset('js/app.min.js') }}"></script>

</body>

</html>
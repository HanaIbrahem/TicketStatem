<!DOCTYPE html>
<html lang="en" dir="ltr"  data-bs-theme="{{ $_COOKIE['theme'] ?? 'light' }}" data-color-theme="Blue_Theme" data-layout="vertical">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Core Css -->
    <link rel="stylesheet" href="{{asset('dashbord/assets/css/styles.css')}}">

    <link rel="stylesheet" href="{{ asset('dashbord/assets/fontawsom/css/all.min.css') }}">

    @yield('datatablecss')
    @yield('selectboxcss')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

    <link rel="icon" href="{{ asset('unnamed.png') }}">

    <title>Teammart-IT</title>
</head>

<body>

    <!--  Body Wrapper -->

    <div id="main-wrapper">
        <x-partials.side />


        <!--  Main wrapper -->
        <div class="page-wrapper">

            <x-partials.header />

            <div class="body-wrapper">



                <div class="container-fluid">
                    @yield('main')
                </div>
            </div>

            <script>
                function handleColorTheme(e) {
                    document.documentElement.setAttribute("data-color-theme", e);
                }
            </script>

            <div class="offcanvas customizer offcanvas-end" style="visibility: none" tabindex="-1" id="offcanvasExample"
                aria-labelledby="offcanvasExampleLabel">
                
                <div class="offcanvas-body h-n80" data-simplebar="">
                    <h6 class="fw-semibold fs-4 mb-2 mt-5">Sidebar Type</h6>
                    <div class="d-flex flex-row gap-3 customizer-box" role="group">
                        <a href="javascript:void(0)" class="fullsidebar">
                            <input type="radio" class="btn-check" name="sidebar-type" id="full-sidebar"
                                autocomplete="off">
                            <label class="btn p-9 btn-outline-primary" for="full-sidebar">
                                <i class="icon ti ti-layout-sidebar-right fs-7 me-2"></i>Full
                            </label>
                        </a>
                        <div>
                            <input type="radio" class="btn-check " name="sidebar-type" id="mini-sidebar"
                                autocomplete="off">
                            <label class="btn p-9 btn-outline-primary" for="mini-sidebar">
                                <i class="icon ti ti-layout-sidebar fs-7 me-2"></i>Collapse
                            </label>
                        </div>
                    </div>

                   
                </div>
            </div>
        </div>

    </div>



    {{-- Required venddors --}}
    <script src="{{ asset('dashbord/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('dashbord/assets/js/vendor.min.js') }}"></script>
    <script src="{{asset('dashbord/assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('dashbord/assets/js/toastr.min.js')}}"></script>
    <script src="{{ asset('dashbord/assets/js/app.init.js') }}"></script>
    <script src="{{ asset('dashbord/assets/js/theme.js') }}"></script>
    <script src="{{ asset('dashbord/assets/js/app.min.js') }}"></script>
    <x-toster />
    @yield('datatablejs')
    @yield('selectboxjs')
    @yield('switalertjs')
    @stack('scripts')

</body>

</html>

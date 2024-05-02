<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('dashbord/assets/css/styles.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashbord/assets/css/styles.css') }}">

    <link rel="stylesheet" href="{{ asset('dashbord/assets/fontawsom/css/all.min.css') }}">
    @yield('datatablecss')
    @yield('selectboxcss')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >

    <link rel="icon" href="{{ asset('unnamed.png') }}">

    <title>Teammart-IT</title>
</head>

<body class="bg-light">

    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6"
        data-sidebartype="full"data-sidebar-position="fixed" data-header-position="fixed">
        <x-partials.side />


        <!--  Main wrapper -->
        <div class="body-wrapper">
            <x-partials.header />


            <div class="container-fluid">
                @yield('main')
            </div>
        </div>
    </div>



    <script src="{{ asset('dashbord/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('dashbord/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dashbord/assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('dashbord/assets/js/app.min.js') }}"></script>
    {{-- <script src="{{ asset('dashbord/assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('dashbord/assets/libs/simplebar/dist/simplebar.js') }}"></script> --}}
    <script src="{{ asset('dashbord/assets/js/dashboard.js') }}"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


    <x-toster />
    @yield('datatablejs')
    @yield('selectboxjs')
    @yield('switalertjs')


</body>

</html>

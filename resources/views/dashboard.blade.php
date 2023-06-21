<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <script src="../assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>GO FIT</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <link href="/css/dashboard.css" rel="stylesheet">

    <style>
        @media print {

            .no-print,
            .no-print * {
                display: none !important;
            }
        }
    </style>
</head>

<body style="background-color: #ECF9FF">
    <header class="navbar navbar-dark sticky-top flex-md-nowrap p-0 shadow no-print" style="background-color: #448EF6;">
        <a class="text-center navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="{{ url('/dashboard') }}">GO FIT</a>


        <div class="navbar-nav">
            <div class="nav-item" style="background-color:#448EF6;color: white">
                <a class="btn px-3" href="{{ url('/logout') }}">Logout</a>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse"
                style="background-color:#D7E9F7">
                <div class="position-sticky pt-3 sidebar-sticky">
                    @include('menu')
                </div>
            </nav>
        </div>
    </div>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        @include('message')
        @yield('container')
    </main>
</body>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@yield('footer-script')

</html>

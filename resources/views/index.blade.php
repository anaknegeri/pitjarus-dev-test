<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/assets/css/daterangepicker.css" />
    <link rel="stylesheet" type="text/css" href="/assets/css/apexcharts.css" />
    @livewireStyles

    <style>
        .navbar {
            box-shadow: inset 0 -1px 0 rgba(0, 0, 0, .1);
        }

        @media (min-width: 767.98px) {
            .navbar {
                top: 0;
                position: sticky;
                z-index: 999;
            }
        }

    </style>
</head>

<body>
    <nav class="navbar navbar-light bg-light py-4">
    </nav>
    <div class="container">
        <div class="row">
            <main class="col-md-12 py-4">
                <livewire:home />
                <footer class="pt-5 d-flex justify-content-between">
                    <span>Copyright © 2022</span>
                </footer>
            </main>
        </div>
    </div>
    @livewireScripts
    <script type="text/javascript" src='/assets/js/jquery.min.js'></script>
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="/assets/js/apexcharts.min.js"></script>
    <script type="text/javascript" src="/assets/js/moment.min.js"></script>
    <script type="text/javascript" src="/assets/js/daterangepicker.min.js"></script>
    @stack('scripts')
</body>

</html>

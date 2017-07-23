<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, width=device-width">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Cars Rental: @yield('title')</title>

    <link rel="stylesheet"
          href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css"
          integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ"
          crossorigin="anonymous">
    <style>
        .container {
            padding-top: 20px;
        }

        .help-block {
            padding-left: 10px;
            font-weight: 700;
            color: red;
        }
    </style>
</head>
<body>
    @component('cars.header')
        <div>content</div>
    @endcomponent

    <div class="container">
        <div class="row">
            <div class="col-md-12 main">
                @section('content')
                    <p>content</p>
                @show
            </div>
        </div>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>@yield('title', 'File Management System')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/sidebar.css')}}">
    <link rel="stylesheet" href="{{asset('css/header.css')}}">
    <link rel="stylesheet" href="{{asset('css/all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/custom-table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/image-picker.css') }}">


    <style>
        .main-content {
            margin-left: 250px; /* Offset content by the sidebar width */
            margin-top: 80px;
            padding: 20px; /* Add padding for better readability */
            flex-grow: 1;
        }
    </style>

</head>
<body>

<div class="d-flex">
    @include('partials.sidebar')  <!-- Include Sidebar -->
    <div class="main-content d-flex flex-column">
        @include('partials.header') <!-- Header content -->
        <div class="container-fluid mt-4">
            @yield('content') <!-- Main content -->
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="{{asset('js/sidebar.js')}}"></script>
</body>
</html>

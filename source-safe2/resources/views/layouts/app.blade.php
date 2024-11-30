<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'File Management System')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{asset('css/sidebar.css')}}">
    <link rel="stylesheet" href="{{asset('css/header.css')}}">
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


<script src="{{asset('js/sidebar.js')}}"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- icons css file --}}
    <link rel="stylesheet" href="{{asset('CSS/all.min.css')}}">
    {{-- css file --}}
    <link rel="stylesheet" href="{{asset('CSS/master.css')}}">
    <title>@yield('titleOfPage','الصفحة الرئيسية')</title>
</head>
<body>
    <div class="container">
        <div class="nav">
            <i class="fa-solid fa-folder-closed"></i>
            <h2>Source Safe</h2>
            <i class="fa-solid fa-bell"></i>
            <i class="fa-regular fa-user"></i>
        </div>
        <div class="content"></div>
        <div class="sidebar"></div>
    </div>
</body>
</html>
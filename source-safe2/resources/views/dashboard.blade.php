@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
@include('components.alert.AlertMessages')
<div style="background-image: url('{{ asset('storage/img/dashboard2.png') }}');
            background-size: cover;
            background-position: center;
            height: 84vh;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;">
</div>

@endsection

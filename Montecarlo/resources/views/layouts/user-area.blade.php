<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    
    @stack('prepend-style')
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.4/r-2.2.9/datatables.min.css"/> --}}

    @include('component.style')
    @stack('addon-style')
    
</head>
<body>
 
    {{-- Navbar --}}
    @include('component.navbar')

    {{-- Sidebar --}}
    @include('component.sidebar-user')

    {{-- Content --}}
    @yield('usercontent')

    {{-- footer --}}
    @include('component.footer')

    {{-- Script --}}
    @include('component.script')
  
    @stack('prepend-script')
    {{-- <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script> --}}
    @stack('addon-script')
</body>
</html>


 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    
    @stack('prepend-style')
    @include('component.style')
    @stack('addon-style')
    
</head>
<body>
 
    {{-- Navbar --}}
    {{-- @include('component.navbar') --}}

    {{-- Sidebar --}}
    {{-- @include('component.sidebar') --}}

    {{-- Content --}}
    @yield('content')

    {{-- footer --}}
    {{-- @include('component.footer') --}}

    {{-- Script --}}
    @include('component.script')
  
</body>
</html>
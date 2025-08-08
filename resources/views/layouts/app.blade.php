<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.partial.head')
</head>
<body>
    @guest
    @yield('content')
    @else
<div class="wrapper">
        @include('layouts.partial.sidebar')
<div class="main">
        @include('layouts.partial.nav')
<main class="content">
<div class="container-fluid p-0">
    @yield('content')
</div>
</main>
     @include('layouts.partial.footer')
</div>
</div>
    @include('layouts.partial.footerScript')
    @endguest
</body>
</html>

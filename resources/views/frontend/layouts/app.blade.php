<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>@yield('title')</title>
    <meta name="description" content="doctor patient portal">
    <meta name="keywords" content="doctor patient portal">

    @include('frontend.layouts.partials.style')
</head>

<body class="index-page">

    @include('frontend.layouts.partials.header')

    <main class="main">

        @yield('content')

    </main>

    @include('frontend.layouts.partials.footer')

    @include('frontend.layouts.partials.scrolltop')
    
    @include('frontend.layouts.partials.script')
</body>

</html>

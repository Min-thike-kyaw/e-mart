<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>
    @include('frontend.layouts.header')
    @yield('links')

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    @include('frontend.layouts.nav')

    <!-- Start Slider -->
    @yield('content')

    <!-- Start Footer  -->
    @include('frontend.layouts.footer')
</body>

    @yield('script')
</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title')</title>
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8"/>
    <meta name="keywords" content="shoes"/>
    <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0)
        }, false)

        function hideURLbar() {
            window.scrollTo(0, 1)
        }
    </script>
    <!-- //Meta tag Keywords -->
    <!-- Custom-Files -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="{{asset('/template/css/bootstrap.css')}}">
    <!-- Bootstrap-Core-CSS -->
    <link rel="stylesheet" href="{{asset('/template/css/style.css')}}" type="text/css" media="all" />
    <!-- Style-CSS -->
    <!-- font-awesome-icons -->
    <link href="{{asset('/template/css/font-awesome.css')}}" rel="stylesheet">
    <!-- //font-awesome-icons -->
    <!-- /Fonts -->
    <link href="//fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Source+Sans+Pro:200,200i,300,300i,400,400i,600,600i,700,700i,900" rel="stylesheet">
    <!-- //Fonts -->
    @yield('custom_import')
</head>

<body>
<!-- /Header -->
@include('user.layouts.partials.header')
<!-- //Header -->

<!-- /Main-Contents -->

@yield('content')
<!-- //Main-Contents -->

<!-- /Footer -->
@yield('custom_footer_script')
@include('user.layouts.partials.footer')
<!-- //Footer -->
</body>

</html>

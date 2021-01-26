<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
</head>

<body class="hold-transition skin-red sidebar-mini">

    @yield('content')

    <footer class="main-footer text-center">
        <strong>Copyright &copy; 2020 <a href="#">Suculentas Armenia</a>.</strong> Todos los Derechos Reservados.
    </footer>


    <!-- jQuery -->
    <script src="{{asset('js/jquery.js')}}"></script>
    <!-- Popper Js -->
    <script src="{{asset('js/popper.min.js')}}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
</body>

</html>
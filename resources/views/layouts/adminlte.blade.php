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
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
    <!-- All Skins -->
    <link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="{{asset('css/datatables.min.css')}}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{asset('css/toastr.min.css')}}">
    <!-- Select 2 -->
    <link href="{{asset('css/select2.min.css')}}" rel="stylesheet" />
</head>

<body class="hold-transition skin-red sidebar-mini">
    <div class="wrapper">

        @include('layouts.menu')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Main content -->
            <section class="content">

                <div class="row">
                    <div class="col-md-12">
                        <div class="box">
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        @yield('content')
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.row -->
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->

    </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
    <!--Fin-Contenido-->
    <footer class="main-footer text-center">
        <strong>Copyright &copy; 2020 <a href="#">Suculentas Armenia</a>.</strong> Todos los Derechos Reservados.
    </footer>


    <!-- jQuery -->
    <script src="{{asset('js/jquery.js')}}"></script>
    <!-- Popper Js -->
    <script src="{{asset('js/popper.min.js')}}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('js/app.min.js')}}"></script>
    <!-- Trumbowyg -->
    <script src="{{asset('dist/trumbowyg.min.js')}}"></script>
    <!-- DataTables JS -->
    <script src="{{asset('js/datatables.min.js')}}"></script>
    <!-- Sweet Alert -->
    <script src="{{asset('js/sweetalert2.all.min.js')}}"></script>
    <!-- Toastr -->
    <script src="{{asset('js/toastr.min.js')}}"></script>
    <!-- Select 2 -->
    <script src="{{asset('js/select2.min.js')}}"></script>

    @yield('scripts')

    <!-- SCRIP DATATABLE -->
    <script>
        $(document).ready(function() {
            $('#trumbowyg-demo').trumbowyg();

            $('#example').DataTable({
                "language": {
                    "lengthMenu": "Mostrar _MENU_ registros por página",
                    "zeroRecords": "No se encontro la página, lo siento!",
                    "info": "Mostrando pagina _PAGE_ de _PAGES_",
                    "infoEmpty": "No valores disponibles",
                    "search": "Buscar",
                    "paginate": {
                        "first": "Primera",
                        "last": "Ultima",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    },
                    "infoEmpty": "Mostrando 0 a 0 de 0 entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total registros)"
                }
            });

            $('.mi-selector').select2();
        });
    </script>
</body>
</html>
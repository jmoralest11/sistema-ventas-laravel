<header class="main-header">

    <!-- Logo -->
    <a href="{{url('/mtventas')}}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>MT</b>V</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>MTVentas</b></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->

                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <small class="bg-green">Online</small>
                        <span class="hidden-xs">{{Auth::user()->name}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <p>
                                Desarrollado Por: <br>
                                Juan Pablo Morales Tames
                                <small>Desarrollador de Software</small>
                                <small>Técnico en Desarrollo de Aplicaciones Informáticas y Financieras - Tecnólogo en Sistemas de Información Empresarial</small>
                                <small>(Cotecnova)</small>
                            </p>
                        </li>

                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-right">
                                <a href="{{ route('logout') }}" class="btn btn-default btn-flat" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Cerrar Sesión') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </nav>
</header>

<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header"></li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-laptop"></i>
                    <span>Almacén</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{url('/articulos')}}"><i class="fa fa-circle-o"></i> Artículos</a></li>
                    <li><a href="{{url('/categorias')}}"><i class="fa fa-circle-o"></i> Categorías</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>Compras</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{url('/ingresos')}}"><i class="fa fa-circle-o"></i> Ingresos</a></li>
                    <li><a href="{{url('/proveedores')}}"><i class="fa fa-circle-o"></i> Proveedores</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-shopping-cart"></i>
                    <span>Ventas</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{url('/ventas')}}"><i class="fa fa-circle-o"></i> Ventas</a></li>
                    <li><a href="{{url('/clientes')}}"><i class="fa fa-circle-o"></i> Clientes</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-folder"></i> <span>Acceso</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{url('/usuarios')}}"><i class="fa fa-circle-o"></i> Usuarios</a></li>

                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
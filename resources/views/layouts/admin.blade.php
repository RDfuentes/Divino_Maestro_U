<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>El_Divino_Mestro</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}"> <!-- funcion css para buscar en una lista--> 
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">



    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}">
    <link rel="apple-touch-icon" href="{{asset('img/logo_marlex.png')}}">
    <link rel="shortcut icon" href="{{asset('img/logo_marlex.png')}}">

  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">

         <!-- Logo -->
        <a href="{{ url('/clientes') }}" class="logo"> 
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>D</b>M</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Divino Maestro</b></span>
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
              <li>
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    {{ __('Cerrar Sesion') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
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
                <i class="fa fa-check-circle"></i>
                <span>Direcciones / Fabricas</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ url('/envios') }}"><i class="fa fa-circle-o"></i>Direcciones de envio</a></li>
                <li><a href="{{ url('/fabricas') }}"><i class="fa fa-circle-o"></i>Fabricas</a></li>
              </ul>
            </li> 

            <li class="treeview">
              <a href="{{ url('/clientes') }}">
                <i class="fa fa-users"></i>
                <span>Clientes</span>
              </a>
            </li>

            <li class="treeview">
              <a href="{{ url('/articulos') }}">
                <i class="fa fa-cube"></i>
                <span>Articulos</span>
              </a>
            </li>

            <li class="treeview">
              <a href="{{ url('/pedidos') }}">
                <i class="fa fa-money"></i>
                <span>Pedidos</span>
              </a>
            </li>

            <li class="treeview">
              <a href="{{ url('/bitacoras') }}">
                <i class="fa fa-money"></i>
                <span>Bitacora Articulos</span>
              </a>
            </li>

          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>





         <!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">

          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">El Divino Maestro</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>

                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                      <div class="col-md-12">
                              <!--Contenido-->
                              @yield('contenido')
                              <!--Fin Contenido-->
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
      <footer class="main-footer">
       <div>El Divino Maestro</div>
      </footer>


      
    <!-- jQuery 2.1.4 -->
    <script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
    @stack('scripts') <!-- funcion de stack de laravel para poder usar script en la plantilla deseada -->
    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-select.min.js')}}"></script> <!-- funcion js para buscar en una lista--> 
    <!-- AdminLTE App -->
    <script src="{{asset('js/app.min.js')}}"></script>
    <!-- tabla excel-->
    <script src="{{asset('datatables/TablaExcel.js')}}"></script>



    
    
  </body>
</html>

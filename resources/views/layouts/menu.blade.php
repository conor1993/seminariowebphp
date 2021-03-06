<!DOCTYPE html>
<html lang="en">

<head>

    <title>Seminario</title>

    <!-- Bootstrap Core CSS -->
    <!--<link href="js/vendor/bootstraps/css/bootstrap.css" rel="stylesheet">-->
    <link href="js/vendor/bootstraps/css/bootstrap.min.css" rel="stylesheet">
    <link href="js/dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="js/vendor/bootstraps/css/combined.css" rel="stylesheet">
    <link href="js/vendor/bootstraps/css/menuestilo.css" rel="stylesheet">
    <link href="js/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="js/datatables/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="js/vendor/bootstraps/css/bootstrap-dialog.css" rel="stylesheet">
    <link href="js/vendor/bootstraps/css/bootstrap-dialog.min.css" rel="stylesheet">
    <link href="js/vendor/bootstraps/css/select2.css" rel="stylesheet">
     

    
    <!-- jQuery -->
    <script src="js/vendor/jquery/jquery-3.1.1.min.js"></script>


    <!-- Bootstrap Core JavaScript -->
    <script src="js/vendor/bootstraps/js/bootstrap.js"></script>



     <!-- dialogos -->
    <script src="js/vendor/jquery/bootstrap-dialog.js"></script>
    <script src="js/vendor/jquery/bootstrap-dialog.min.js"></script>
    <script src="js/vendor/jquery/validateNumLetter.js"></script>
    <!-- <link href="js/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css">-->

    <script src="js/datatables/jquery.dataTables.min.js"></script>
    <script src="js/datatables/dataTables.bootstrap.min.js"></script>
    <!-- menu lateral derechoo  nuevo -->


    <!-- select -->
    <script src="js/vendor/jquery/bootstrap-dialog.js"></script>
    <script src="js/vendor/jquery/select2.js"></script>
    <script src="js/vendor/jquery/jquery.datetimepicker.js"></script>

   <link href="css/estilosInput.css" rel="stylesheet">

    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    <script type="text/javascript">
        var UURL = {!! json_encode(url('/')) !!}
   </script>

</head>

<body>
    <div id="wrapper">

        <!-- Navigation -->
        <input type="hidden" id="tokena" name="tokena" value="{{ csrf_token() }}" >
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Seminario</a>
            </div>
            <!-- icono salir -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i>{{ Auth::user()->name }}</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="{{ url('/logout') }}"
                               onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out fa-fw"></i> Logout
                                        </a>

                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                        </form>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>

            <!-- menus y subenus -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">

                    <div id="left" class="">
                        <ul id="menu-group-1" class="nav menu">  
                            <li class="item-1 deeper parent active">
                                <a class="" href="#">
                                    <span data-toggle="collapse" data-parent="#menu-group-1" href="#sub-item-1" class="sign"><i class="icon-plus icon-white"></i></span>
                                    <span class="lbl">Sorteo</span>                      
                                </a>
                                <ul class="children nav-child unstyled small collapse" id="sub-item-1">
                                    <li class="item-2 deeper parent active">
                                        <a class="" href="#">
                                            <span data-toggle="collapse" data-parent="#menu-group-2" href="#sub-item-2" class="sign"><i class="icon-plus icon-white"></i></span>
                                            <span class="lbl">Catálogos</span> 
                                        </a>
                                        <ul class="children nav-child unstyled small collapse" id="sub-item-2">
                                            <li class="item-3">
                                                <a class="" href="{{ url('colaboradores') }}">
                                                    <span class="sign"><i class="icon-play"></i></span>
                                                    <span class="lbl">Colaboradores</span> 
                                                </a>
                                            </li>
                                            <li class="item-4">
                                                <a class="" href="{{ url('cobradores') }}">
                                                    <span class="sign"><i class="icon-play"></i></span>
                                                    <span class="lbl">Cobradores</span> 
                                                </a>
                                            </li>    
                                            <li class="item-5">
                                                <a class="" href="{{ url('canalesdistribucion') }}">
                                                    <span class="sign"><i class="icon-play"></i></span>
                                                    <span class="lbl">Canalaes de distribucion</span> 
                                                </a>
                                            </li>      
                                            <li class="item-5">
                                                <a class="" href="{{ url('gestores') }}">
                                                    <span class="sign"><i class="icon-play"></i></span>
                                                    <span class="lbl">Gestores</span> 
                                                </a>
                                            </li>
                                            <li class="item-5">
                                                <a class="" href="{{ url('sorteos') }}">
                                                    <span class="sign"><i class="icon-play"></i></span>
                                                    <span class="lbl">Sorteos</span> 
                                                </a>
                                            </li>                        
                                        </ul>
                                    </li>
                                    <li class="item-3 deeper parent">
                                        <a class="" href="">
                                            <span data-toggle="collapse" data-parent="#menu-group-3" href="#sub-item-3" class="sign"><i class="icon-plus icon-white"></i></span>
                                            <span class="lbl">Movimientos</span> 
                                        </a>
                                        <ul class="children nav-child unstyled small collapse" id="sub-item-3">
                                            <li class="item-6">
                                                <a class="" href="{{ url('solicitudboletos') }}">
                                                    <span class="sign"><i class="icon-play"></i></span>
                                                    <span class="lbl">Solicitud de boletos</span>                                    
                                                </a>
                                            </li>
                                            <li class="item-8">
                                                <a class="" href="{{ url('autorizacionboletos') }}">
                                                    <span class="sign"><i class="icon-play"></i></span>
                                                    <span class="lbl">Autorizacion de boletos</span>                                    
                                                </a>
                                            </li>
                                            <li class="item-9">
                                                <a class="" href="{{ url('liquidacionboletos') }}">
                                                    <span class="sign"><i class="icon-play"></i></span>
                                                    <span class="lbl">Liquidacion de boletos</span>                                    
                                                </a>
                                            </li>
                                            <li class="item-10">
                                                <a class="" href="{{ url('asignacioncobradores') }}">
                                                    <span class="sign"><i class="icon-play"></i></span>
                                                    <span class="lbl">Asignacion Cobradores</span>                                    
                                                </a>
                                            </li>
                                        </ul>
                                    </li>

                                    <li class="item-4 deeper parent">
                                        <a class="" href="">
                                            <span data-toggle="collapse" data-parent="#menu-group-4" href="#sub-item-4" class="sign"><i class="icon-plus icon-white"></i></span>
                                            <span class="lbl">Reportes</span> 
                                        </a>
                                        <ul class="children nav-child unstyled small collapse" id="sub-item-4">
                                            <li class="item-6">
                                                <a class="" href="{{ url('reportecolaboradores') }}">
                                                    <span class="sign"><i class="icon-play"></i></span>
                                                    <span class="lbl">Reporte colaboradores</span>                                    
                                                </a>
                                            </li>
                                            <li class="item-8">
                                                <a class="" href="{{ url('reporteboletos') }}">
                                                    <span class="sign"><i class="icon-play"></i></span>
                                                    <span class="lbl">Reporte boletos</span>                                    
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="item-1 deeper parent">
                                <a class="" href="#">
                                    <span data-toggle="collapse" data-parent="#menu-group-1" href="#sub-item-8" class="sign"><i class="icon-plus icon-white"></i></span>
                                    <span class="lbl">Biblioteca</span>                      
                                </a>
                                <ul class="children nav-child unstyled small collapse" id="sub-item-8">
                                    <li class="item-9 deeper parent">
                                        <a class="" href="#">
                                            <span data-toggle="collapse" data-parent="#menu-group-1" href="#sub-item-9" class="sign"><i class="icon-plus icon-white"></i></span>
                                            <span class="lbl">Menu 1</span> 
                                        </a>
                                        <ul class="children nav-child unstyled small collapse" id="sub-item-9">
                                            <li class="item-10">
                                                <a class="" href="#">
                                                    <span class="sign"><i class="icon-play"></i></span>
                                                    <span class="lbl">Menu 1.1</span>
                                                </a>
                                            </li>
                                            <li class="item-11">
                                                <a class="" href="#">
                                                    <span class="sign"><i class="icon-play"></i></span>
                                                    <span class="lbl">Menu 1.2</span> 
                                                </a>
                                            </li>                                
                                        </ul>
                                    </li>
                                    <li class="item-12 deeper parent">
                                        <a class="" href="#">
                                            <span data-toggle="collapse" data-parent="#menu-group-1" href="#sub-item-12" class="sign"><i class="icon-plus icon-white"></i></span>
                                            <span class="lbl">Menu 2</span> 
                                        </a>
                                        <ul class="children nav-child unstyled small collapse" id="sub-item-12">
                                            <li class="item-13">
                                                <a class="" href="#">
                                                    <span class="sign"><i class="icon-play"></i></span>
                                                    <span class="lbl">Menu 2.1</span>                                    
                                                </a>
                                            </li>
                                            <li class="item-14">
                                                <a class="" href="#">
                                                    <span class="sign"><i class="icon-play"></i></span>
                                                    <span class="lbl">Menu 2.2</span>                                    
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li> 

                        </ul>     

                    </div>
                  
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <br>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <div class="row">
                 <div class="col-lg-12">
                        @yield('contenido')
                  </div>
              
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
        </div>

    </div>
    <!-- /#wrapper -->
</body>

</html>

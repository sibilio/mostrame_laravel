<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{env('SITE_NAME', "teste")}}</title>
    <link rel="stylesheet" type="text/css" href="{{env('APP_URL')}}/css/app.css">

    @yield('css')

    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">{{env('SITE_NAME', "teste")}}</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {{Auth::user()->name}} <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{route('users.showViewNewPassword')}}"><i class="fa fa-key" aria-hidden="true"></i> Modificar senha</a>
                            <a href="{{route('login::out')}}"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li id="menu-dashboard" class="menu-item active">
                        <a href="{{route('dashboard')}}"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    @if(Auth::user()->canSeeMenu('menu.master'))
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-id-card" aria-hidden="true"></i> Master <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            @if(Auth::user()->canSeeMenu('menu.master.permissoes'))
                            <li id="menu-permissoes" class="menu-item">
                                <a href="{{route('permissoes.index')}}">Permissões</a>
                            </li>
                            @endif
                            @if(Auth::user()->canSeeMenu('menu.master.papeis'))
                            <li id="menu-papeis" class="menu-item">
                                <a href="{{route('papeis.index')}}">Papeis</a>
                            </li>
                            @endif
                            @if(Auth::user()->canSeeMenu('menu.master.atribuicao'))
                            <li id="menu-atribuicoes" class="menu-item">
                                <a href="{{route('atribuicoes.index')}}">Atribuição</a>
                            </li>
                            @endif
                            @if(Auth::user()->canSeeMenu('menu.master.dados'))
                            <li id="menu-dados" class="menu-item">
                                <a href="{{route('dados.index')}}">Chaves de dados</a>
                            </li>
                            @endif
                        </ul>
                    </li>
                    @endif
                    @if(Auth::user()->canSeeMenu('menu.usuario'))
                    <li id="menu-usuarios" class="menu-item">
                        <a href="{{route('users.index')}}"><i class="fa fa-fw fa-address-book-o"></i> Usuários</a>
                    </li>
                    @endif
                    <!-- Código de exemplo para utilização somente --------------------------
                    <li id="menu-anunciantes" class="menu-item">
                        <a href="#"><i class="fa fa-fw fa-handshake-o"></i> Anunciantes</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-filter"></i> Classificações <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li id="menu-categorias" class="menu-item">
                                <a href="#">Categorias</a>
                            </li>
                            <li id="menu-cidades" class="menu-item">
                                <a href="#">Cidades</a>
                            </li>
                            <li id="menu-produtos" class="menu-item">
                                <a href="#">Produtos</a>
                            </li>
                        </ul>
                    </li>
                    ------------------------------------------------------------------------->
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
        <div id="page-wrapper">

            <div class="container-fluid">
               @yield('content')
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

    <script src="{{env('APP_URL')}}/js/app.js"></script>

    <script>
      defineMenuAtivo = function(menu){
         $(".menu-item").removeClass('active');
         var seletor = "#" + menu;
         console.log(seletor);
         $(seletor).addClass('active');
      };
    </script>
    
    @yield('script')
    
</body>

</html>

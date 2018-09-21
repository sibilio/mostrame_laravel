<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Móstrame</title>
   <?php 
      $http_path = env('BASE_HTML');
   ?>
    <link href="https://fonts.googleapis.com/css?family=Russo+One" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <!-- Bootstrap Core CSS -->
    <link href="<?= $http_path.'css/app.css'; ?>" rel="stylesheet">
    <link href="<?= $http_path.'css/web.css'; ?>" rel="stylesheet">
    
    @yield('css')

    <!-- Custom Fonts -->
    <!-- <script src="https://use.fontawesome.com/766bc860c0.js"></script> -->
    <link href="<?= $http_path.'BaseApp/font-awesome/css/font-awesome.min.css'?>" rel='stylesheet'>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
   
@yield('content')

@include('Web.rodape')
    <script src="{{env('APP_URL')}}/js/app.js"></script>
<!-- jQuery -->
    <script src="<?= $http_path.'BaseApp/js/jquery.js'?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?= $http_path.'BaseApp/js/bootstrap.min.js'?>"></script>

    <!-- Arquivos do BaseApp -->
    <script src="<?= $http_path.'BaseApp/js/BaseApp.js'?>"></script>

    @yield('script')
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{env('SITE_NAME', "teste")}}</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{env('APP_URL')}}/css/app.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
   <style>     
      body{
         background-color: rgb(250, 250, 250);
      }
   </style>
</head>

<body>
   <div class="col-md-4 col-sm-12">
      <div class="alert alert-danger" role="alert">
         <p>
            A requisição para a mudança de senha não é mais válida.<br>
            Por favor, se necessário refaça o pedido.
         </p>
      </div>
      <a href="{{route('login')}}" class="btn btn-success">Voltar para a tela de login</a>
   </div>
   <script src="{{env('APP_URL')}}/js/app.js"></script>
</body>
</html>
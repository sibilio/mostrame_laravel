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

    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
   <div class="container">
      <div class="jumbotron">
         <h1>Site temporariamente fora de serviço!</h1>
         <h1>Desculpe-nos o transtorno!</h1>
      </div>
   </div>
        <!-- /#wrapper -->

   <script src="{{env('APP_URL')}}/js/app.js"></script>
</body>

</html>
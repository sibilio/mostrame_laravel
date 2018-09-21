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
       .label-password{
          margin-top: 15px;
       }
       
       .margim-botao{
          margin-top: 15px;
       }
       
       body{
          background-color: rgba(0,0,0, .02);
       }
   </style>
</head>

<body>
   <div class='container'>
    @if ($mensagem)
      <div class="alert alert-success" role="alert">
         <p>
            Caso seu email exista em nosso cadastro, enviaremos 
            uma mensagem para prosseguir com a renovação da senha.<br>
            <strong>Por favor cheque seu email para continuar.</strong>
         </p>
      </div>
    @else
      @include('templates.erros')
      <div id='login-container' class="col-md-12">
         <div class="col-md-4"></div>
         <div class='col-md-4'>
            <div class="panel panel-primary">
               <div class="panel-heading">Recuperação de senha em {{env('SITE_NAME', 'teste')}}</div>
               <div class="panel-body" id='painel-login'>
                  <form method='post' action='{{route('recovery::enviarLink')}}'>
                        {{ csrf_field() }}
                        
                        <div class='col-md-12'>
                           <label class="label-password" for='email'>Email</label>
                        </div>
                        <div class="col-md-12">
                           <input class='form-control' type='email' id='email' name='email'>
                        </div>
                        
                        <div class='pull-right'>
                           <div class="col-md-8">
                              <a href='{{route('login')}}' class="btn btn-danger margim-botao">Voltar para a tela de login</a>
                           </div>
                           <div class="col-md-4">
                              <input id="submit" type='submit' class="btn btn-success margim-botao" value="Confirmar">
                           </div>
                        </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
     @endif
   </div>
   
   <script src="{{env('APP_URL')}}/js/app.js"></script>
   <script>
     $('#login-container').center();
   </script>
</body>
</html>
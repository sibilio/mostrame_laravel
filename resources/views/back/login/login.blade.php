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
       #submit{
          margin-top: 15px;
       }
       
       #label-password{
          margin-top: 15px;
       }
       
       #botao-novo{
          margin-top: 15px;
       }
       
       body{
          background-color: rgba(0,0,0, .02);
       }
       
       .link-esqueci-senha{
          padding-top: 28px;
       }
       
       .lembrar-acesso{
          padding-left: 15px;
       }
    </style>
</head>

<body>
   <div class='container'>
      <div class="col-md-12">
         @include('templates.erros')
      </div>
      <div id='login-container' class="col-md-12">
         <div class="col-md-4"></div>
         <div class='col-md-4'>
            <div class="panel panel-primary">
               <div class="panel-heading">Login {{env('SITE_NAME', "teste")}}</div>
               <div class="panel-body" id='painel-login'>
                  @if(isset($loginErr))
                     @if($loginErr)
                     <div class="alert alert-danger" role="alert">
                        Seu <strong>email</strong> ou <strong>senha</strong> 
                        estão <strong>incorretos</strong>. Tente novamente!
                     </div>
                     @endif
                  @endif
                  
                  <form method='post' action='{{route('login::doLogin')}}'>
                        {{ csrf_field() }}
                        <div class='col-md-12'>
                           <label for='email'>E-mail</label>
                        </div>
                        <div class="col-md-12">
                           <input class='form-control' type='email' id='email' name='email' placeholder="Digite seu e-mail">
                        </div>
                        <div class='col-md-12'>
                           <label id="label-password" for='password'>Senha</label>
                        </div>
                        <div class="col-md-12">
                           <input class='form-control' type='password' id='password' name='password'>
                        </div>
                        <div class="checkbox pull-left lembrar-acesso">
                          <label>
                            <input id="remember-me" name='remember' type="checkbox">Lembrar meu acesso
                          </label>
                        </div>
                        <div class='pull-right'>
                           <div class="col-md-12">
                              <div class="col-md-8 link-esqueci-senha">
                                 <a href="{{route('recovery::telaDigitaEmailNovaSenha',['showMessage'=>'no'])}}" class="">Esqueci minha senha</a>
                              </div>
                              <div class="col-md-3">
                                 <input id="submit" type='submit' class="btn btn-success" value="Entrar">
                              </div>
                           </div>
                        </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
    <script src="{{env('APP_URL')}}/js/app.js"></script>
    <script>
      $('#login-container').center();
    </script>
</body>
</html>
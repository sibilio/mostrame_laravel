@extends('Web.template')

@section('css')
<style>    
    img{
        width: 300px;
    }
    h2{
        padding-left: 20px;
        font-family: "Times New Roman","Bodoni","Garamond","Minion Web","ITC Stone Serif","MS Georgia","Bitstream Cyberbit";
    }
</style>
@endsection

@section('content')
@if((isset($confirmacao)?($confirmacao==true):false))
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-1">
               <img src="{{env("HTTP_BASE")}}/images/mostrame.png">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
               <div class="alert alert-success" role="alert">
                   <h2>Email enviado com sucesso! Logo responderemos.<br>Obrigado!</h2>
               </div>
               <a href="{{route('index')}}" class="btn btn-success">Voltar</a>
            </div>
        </div>
    </div>
@else
<div class="row">
     <div class="col-md-1">
        <img src="{{env("HTTP_BASE")}}/images/mostrame.png">
     </div>
</div>
<div class="row">
    <div class="col-md-12">
        <h2>Deixe sua mensagem e logo<br>entraremos em contato</h2></br>
        <form method="POST" action="{{route('contato.enviar-formulario')}}">
            {{csrf_field()}}
            <div class="col-md-4">
                <div class="form-group">
                    <label for='nome'>Nome:</label>
                    <input type="text" name='nome' class="form-control" id='nome'>
                </div>
                <div class="form-group">
                    <label for='email'>Email:</label>
                    <input type="email" name='email' class="form-control" id='email'>
                </div>
                <div class="form-group">
                    <label for='telefone'>Telefone:</label>
                    <input type="text" name="telefone" class="form-control" id="telefone">
                </div>
                <div class="form-group">
                    <label for='mensagem'>Mensagem:</label>
                    <textarea name="mensagem" id="mensagem" class="form-control" rows="7"></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" value="Enviar" class="btn btn-success">
                    <a href="{{route('index')}}" class="btn btn-danger">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endif
@endsection

@section('script')
@endsection
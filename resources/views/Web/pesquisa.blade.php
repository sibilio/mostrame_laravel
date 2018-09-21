@extends('Web.template')

@section('content')
<div id='content' class='container'>
   <img src="{{env("BASE_HTML")}}/images/mostrame.png" id="logo-web">
   <div id="pesquisa-form">
      <div class="row">
         <form class="form" role="form" action="{{route('realiza-pesquisa')}}" method="get">
            <input type="hidden" name='regiao_id' value="{{$regiao->id??''}}">
            <input type="hidden" name='regiao_nome' value="{{$regiao->nome??''}}">
            <div class="col-md-6 col-md-offset-2">
               <input type="text" class="form-control"
                      placeholder="Digite o que deseja pesquisar"
                      name="termo"
                      value="">
            </div>
            <div class="col-md-3">
               <input id='submit-form' type="submit" class="btn btn-default" value="Procurar em {{(is_null($regiao)?"":$regiao->nome)}}">
            </div>
         </form>
      </div>
   </div>
</div>
@endsection

@section('script')

@endsection
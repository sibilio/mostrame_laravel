@extends('Web.template')

@section('content')
<div id='content' class='container'>
   <img src="{{env("BASE_HTML")}}images/mostrame.png" id="logo-web">
   <p id='city-search'>
      Escolha a cidade:
   </p>
   <div id='botoes'>
      @foreach($regioes as $regiao)
      <div class='col-md-3'>
         <a href="{{route('pesquisar', ['regiao'=>$regiao->id])}}">{{$regiao->nome_no_site}}</a>
      </div>
      @endforeach
   </div>
</div>
@endsection

@section('script')
<script>

</script>
@endsection
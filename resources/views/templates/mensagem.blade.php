@extends('templates.admin')

@section('css')
<style>
   p{
      font-size: 20px;
   }
</style>
@endsection

@section('content')
   <div class="alert alert-{{$type}}" role="alert">
      <p>{{$mensagem}}</p>
   </div>
   <div class='col-md-4'>
      <a href='{{route($nome_rota)}}' class='btn btn-primary'>Voltar à listagem</a>
   </div>
@endsection

@section('script')
@endsection
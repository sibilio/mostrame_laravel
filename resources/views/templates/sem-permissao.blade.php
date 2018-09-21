@extends('templates.admin')

@section('css')
<style>
   p{
      font-size: 20px;
   }
   strong{
     text-decoration: underline; 
   }
</style>
@endsection

@section('content')
   <div class="alert alert-danger" role="alert">
      <p>Você <strong>não tem permissão</strong> para execuar está ação.<br>Procure o administrador do sistema.</p>
   </div>
@endsection

@section('script')
@endsection
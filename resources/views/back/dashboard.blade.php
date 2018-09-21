@extends('templates.admin')
@section('content')
<div class="jumbotron">
   <h1>Dashboard</h1>
   <p>Aqui é onde sera o dashboard</p>
</div>
@endsection

@section('script')
   <script>
      $(document).ready(function(){
         defineMenuAtivo('menu-dashboard');
      });
   </script>
@endsection
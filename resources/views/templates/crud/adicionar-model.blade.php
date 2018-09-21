@extends('templates.admin')
<?php
   use App\BaseApp\Presentions\Form;
?>

@section('css')
<style>
   a{
      margin-left: 10px;
   }
</style>
@endsection

@section('content')
<h2 class='atividade'>{{$nome_da_tela}}</h2>
<hr id='linha-atividade'>
@include('templates.erros')
<?php
   Form::open([
      'id' => 'adicionar',
      'method' => 'post',
      'action' => $link_add_action,
   ]);
?>

@yield('formulario')

<?php
   Form::buttonSubmite([
       'color' => 'success',
       'value' => 'Salvar'
   ]);
   Form::buttonLink([
        'href' => route($routePrefix.'.index'),
       'color' => 'danger',
       'label' => 'Cancelar'
   ]);
   Form::close();
?>

@endsection

@section('script')
<script type="text/javascript">

</script>
@endsection


@extends('templates.crud.adicionar-model')

<?php
   use App\BaseApp\Presentions\Form;
   
   $nome_da_tela = "Adicionar novo papel";
   $link_add_action = route('papeis.store');
   $routePrefix = 'papeis';
?>

@section('formulario')
<?php
   
   Form::text([
            'col' => 'col-md-5',
          'label' => 'Descrição',
             'id' => 'descricao',
    'placeholder' => 'Digite a descrição',
          'value' => old('descricao')??''
   ]);
   
?>

@endsection

@extends('templates.crud.editar-model')

<?php
   use App\BaseApp\Presentions\Form;
   
   $nome_da_tela = "Editar papel";
   $link_edit_action = route('papeis.update', ['papei'=>$registro->id]);
   $routePrefix = 'papeis';
?>

@section('formulario')
<?php
   
   Form::text([
            'col' => 'col-md-5',
          'label' => 'Descrição',
             'id' => 'descricao',
    'placeholder' => 'Digite a descrição',
          'value' => old('descricao')??$registro->descricao
   ]);
   
?>

@endsection

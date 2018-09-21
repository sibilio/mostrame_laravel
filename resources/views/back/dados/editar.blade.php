@extends('templates.crud.editar-model')

<?php
   use App\BaseApp\Presentions\Form;
   
   $nome_da_tela = "Editar chave de dados";
   $link_edit_action = route('dados.update', ['dado'=>$registro->id]);
   $routePrefix = 'dados';
?>

@section('formulario')
<?php
   Form::text([
            'col' => 'col-md-5',
          'label' => 'Chave',
             'id' => 'chave',
    'placeholder' => 'Digite a chave',
          'value' => old('chave')??$registro->chave
   ]);
   Form::text([
            'col' => 'col-md-5',
          'label' => 'Valor',
             'id' => 'valor',
    'placeholder' => 'Digite a valor',
          'value' => old('valor')??$registro->valor
   ]);
?>

@endsection

@extends('templates.crud.editar-model')

<?php
   use App\BaseApp\Presentions\Form;
   
   $nome_da_tela = "Editar permissões";
   $link_edit_action = route('permissoes.update', ['permisoe'=>$registro->id]);
   $routePrefix = 'permissoes';
?>

@section('formulario')
<?php
   Form::text([
            'col' => 'col-md-5',
          'label' => 'Tag',
             'id' => 'tag',
    'placeholder' => 'Digite a tag',
          'value' => old('tag')??$registro->tag
   ]);
   Form::text([
            'col' => 'col-md-5',
          'label' => 'Descrição',
             'id' => 'descricao',
    'placeholder' => 'Digite a descrição',
          'value' => old('descricao')??$registro->descricao
   ]);
?>

@endsection

@extends('templates.crud.adicionar-model')

<?php
   use App\BaseApp\Presentions\Form;
   
   $nome_da_tela = "Adicionar nova permissões";
   $link_add_action = route('permissoes.store');
   $routePrefix = 'permissoes';
?>

@section('formulario')
<?php
   
   Form::text([
            'col' => 'col-md-5',
          'label' => 'Tag',
             'id' => 'tag',
    'placeholder' => 'Digite a tag',
          'value' => old('tag')??''
   ]);
   Form::text([
            'col' => 'col-md-5',
          'label' => 'Descrição',
             'id' => 'descricao',
    'placeholder' => 'Digite a descrição',
          'value' => old('descricao')??''
   ]);

?>

@endsection

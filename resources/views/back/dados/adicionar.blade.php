@extends('templates.crud.adicionar-model')

<?php
   use App\BaseApp\Presentions\Form;
   
   $nome_da_tela = "Adicionar nova chave de dados";
   $link_add_action = route('dados.store');
   $routePrefix = 'dados';
?>

@section('formulario')
<?php
   
   Form::text([
            'col' => 'col-md-5',
          'label' => 'Chave',
             'id' => 'chave',
    'placeholder' => 'Digite a chave',
          'value' => old('chave')??''
   ]);
   Form::text([
            'col' => 'col-md-5',
          'label' => 'Valor',
             'id' => 'valor',
    'placeholder' => 'Digite a valor',
          'value' => old('valor')??''
   ]);

?>

@endsection

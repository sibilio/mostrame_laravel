@extends('templates.crud.adicionar-model')

<?php
   use App\BaseApp\Presentions\Form;
   
   $nome_da_tela = "Adicionar novo usuário";
   $link_add_action = route('users.store');
   $routePrefix = 'users';
?>

@section('formulario')
<?php
   Form::text([
            'col' => 'col-md-5',
          'label' => 'Nome',
             'id' => 'name',
    'placeholder' => 'Digite o nome',
          'value' => old('name')??''
   ]);
   Form::email([
            'col' => 'col-md-5',
          'label' => 'email',
             'id' => 'descricao',
    'placeholder' => 'Digite o email',
          'value' => old('email')??''
   ]);
   Form::text([
            'col' => 'col-md-5',
          'label' => 'Senha',
             'id' => 'password',
    'placeholder' => 'Digite uma senha provisória',
          'value' => old('password')??''
   ]);
   Form::papelCombo([
            'col' => 'col-md-5',
          'label' => 'Papel',
          'value' => old('papel_id')??''
   ]);

?>

@endsection

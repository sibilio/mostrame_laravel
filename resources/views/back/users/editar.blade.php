@extends('templates.crud.editar-model')

<?php
   use App\BaseApp\Presentions\Form;
   
   $nome_da_tela = "Editar usuário";
   $link_edit_action = route('users.update', ['user'=>$registro->id]);
   $routePrefix = 'users';
?>

@section('formulario')
<input type='hidden' name='password' value='{{$registro->password}}'>
<?php
   Form::text([
            'col' => 'col-md-5',
          'label' => 'Nome',
             'id' => 'name',
    'placeholder' => 'Digite o nome',
          'value' => old('name')??$registro->name
   ]);
   Form::email([
            'col' => 'col-md-5',
          'label' => 'email',
             'id' => 'email',
    'placeholder' => 'Digite o email',
          'value' => old('email')??$registro->email
   ]);
   Form::papelCombo([
            'col' => 'col-md-5',
          'label' => 'Papel',
          'value' => old('papel_id')??$registro->papel_id
   ]);
?>

@endsection

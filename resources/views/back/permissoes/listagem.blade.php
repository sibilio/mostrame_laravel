@extends('templates.crud.listagem-model')

<?php
   $nome_da_tela = "Listagem de permissões";
   $routePrefix = 'permissoes';
   $campo_pesquisar = 'tag';
   $place_hold_pesquisa = "Digite a tag para a pesquisa";
   $td_path = 'back.permissoes.tds'; //as linhas da tabela
?>

@section('th')
   <th>Tag</th>
   <th>Descrição</th>
@endsection


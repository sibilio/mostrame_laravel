@extends('templates.crud.listagem-model')

<?php
   $nome_da_tela = "Listagem de chaves de dados";
   $routePrefix = 'dados';
   $campo_pesquisar = 'chave';
   $place_hold_pesquisa = "Digite a chave para a pesquisa";
   $td_path = 'back.dados.tds'; //as linhas da tabela
?>

@section('th')
   <th>Chave</th>
   <th>Valor</th>
@endsection


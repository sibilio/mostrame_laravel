@extends('templates.crud.listagem-model')

<?php
   $nome_da_tela = "Listagem de papeis";
   $routePrefix = 'papeis';
   $campo_pesquisar = 'descricao';
   $place_hold_pesquisa = "Digite a descrição do papel que deseja pesquisar";
   $td_path = 'back.papeis.tds'; //as linhas da tabela
?>

@section('th')
   <th>Descrição</th>
@endsection


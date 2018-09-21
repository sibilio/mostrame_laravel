<?php use \App\BaseApp\Presentions\Form; ?>
@extends('templates.admin')

@section('css')
<style>
   .btn{
      margin-left: 10px;
   }
</style>
@endsection

@section('content')
   <h2 class='atividade'>Mudar senha de {{Auth::user()->name}}:</h2>
   <hr id='linha-atividade'>
   @include('templates.erros')
   <?php
      if(!isset($message)){
         Form::open([
             'id' => 'mudar-senha',
             'action' => route('users.changePassword'),
             'method' => 'put'
         ]);

         Form::password([
             'col'=>'col-md-5',
             'row'=>true,
             'label'=>'Nova senha',
             'id'=>'nova-senha',
             'placeholder'=>'Digite sua nova senha'
         ]);

         Form::password([
             'col'=>'col-md-5',
             'row'=>true,
             'label'=>'Confirmação de senha',
             'id'=>'confirmacao-senha',
             'placeholder'=>'Digite sua nova senha para a confirmação'
         ]);

         Form::buttonSubmite(['color'=>'success', 'value'=>'Confirmar']);

         Form::buttonLink([
             'color'=>'danger',
             'label'=>'Cancelar',
             'href'=>route('dashboard')
         ]);

         Form::close();
      }
   ?>
   @if(isset($message) && $message===true)
      <div class="alert alert-success" role="alert">
         Senha alterada com sucesso!!!
      </div>
   @endif
@endsection

@section('script')
@endsection
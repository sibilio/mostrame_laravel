@extends('templates.admin')
<?php
   use App\BaseApp\Presentions\Form;
?>

@section('css')
<style>
   #botao-mostra-permissao{
      margin-top: 25px;
   }
   .permitido{
      background-color: #DFF0D8;
      color: #4B763D;
      border-radius: 7px;
      border-color: #4B763D;
      border-width: 2px;
      padding: 4px;
      font-weight: bold;
      text-align: center;
      font-size: 18px;
   }
   .bloqueado{
      background-color: #F2DEDE;
      color: #AD4442;
      border-radius: 7px;
      border-color: #AD4442;
      border-width: 2px;
      padding: 4px;
      font-weight: bold;
      text-align: center;
      font-size: 18px;
   }
   .botao-bloquear{
      /*apenas para utilização com jQuery*/
   }
   .botao-permitir{
      /*apenas para utilização com jQuery*/
   }
</style>
@endsection

@section('content')
   <h2 class='atividade'>Atribuições de permissões</h2>
   <hr id='linha-atividade'>
   <div class='container-fluid'>
   <?php   
      Form::papelCombo([
            'col' => 'col-md-3',
            'label' => 'Papel',
            'row' => false,
            'value' => $papel_id??''
      ]);
      Form::buttonLink([
          'href'=>"#",
          'id'=>'botao-mostra-permissao',
          'color'=>'primary',
          'label'=>'Mostrar permissões do papel'
      ]);
      $permitido = false; //usado para definir se aparece o botão Permitir ou Bloquear
   ?>
   </div>
   @if(isset($permissoes) && isset($permissoesPapel))
      <div class="container-fluid">
         <table class='table'>
            <thead>
               <tr>
                  <th>ID</th>
                  <th style="text-align:center">Permissão</th>
                  <th>Tag</th>
                  <th>Descrição</th>
                  <th>Operação</th>
               </tr>
            </thead>
            <tbody>
               @foreach($permissoes as $permissao)
               <tr>
                  <td>{{$permissao->id}}</td>
                  
                  @foreach($permissoesPapel as $permissaoPapel)
                     @if($permissaoPapel->permissao_id == $permissao->id)
                        <td><div class='permitido'>sim</div></td>
                        <td>{{$permissao->tag}}</td>
                        <td>{{$permissao->descricao}}</td>
                        <td>
                           <a href='#' class='btn btn-danger botao-bloquear'
                               data-permissao_id='{{$permissao->id}}'>Bloquear
                           </a>
                        </td>
                        <?php $permitido = true; ?>
                     @endif
                  @endforeach
                  
                  @if($permitido == false)
                     <td><div class='bloqueado'>não</div></td>
                     <td>{{$permissao->tag}}</td>
                     <td>{{$permissao->descricao}}</td>
                     <td>
                        <a href='#' class='btn btn-success botao-permitir'
                           data-permissao_id='{{$permissao->id}}'>Permitir
                        </a>
                     </td>
                  @endif
                  <?php $permitido = false; ?>
               </tr>
               @endforeach
            </tbody>
         </table>
      </div>
   @endif
@endsection

@section('script')
<script>
$(document).ready(function(){
   $('#botao-mostra-permissao').click(function(e){
      e.preventDefault();
    
      var idPapel = $('#papel-combo').val();
      var href = "{{route('atribuicoes.selecionar-papel', ['papel_id'=>'000papel'])}}";
      
      href = href.replace('000papel', idPapel);
      location.href = href;
   });
   
   var rotaMudarPermissao = function(operacao, papel_id, permissao_id){
      var rota = "{{route('atribuicoes.mudar-permissao',['operacao'=>'operacao', 'papel_id'=>'papel_id', 'permissao_id'=>'permissao_id'])}}";
      rota = rota.replace('operacao', operacao);
      rota = rota.replace('papel_id', papel_id);
      rota = rota.replace('permissao_id', permissao_id);
      return rota;
   };
   
   $(document).on('click', '.botao-bloquear', function(e){
      e.preventDefault();
      
      var idPapel = $('#papel-combo').val();
      var idPermissao = $(this).data('permissao_id');
      
      var tr = $(this).parents('tr');
      var td = $(this).parent('td');
      var controle = tr.find('.permitido');
      
      controle.removeClass('permitido');
      controle.addClass('bloqueado');
      controle.text('não');
      
      td.remove();
      tr.append("<td><a href='#' class='btn btn-success botao-permitir' data-permissao_id='"+idPermissao+"'>Permitir</a></td>");
      
      var rota = rotaMudarPermissao('b', idPapel, idPermissao);
      
      //executa a rota que faz a mudança de permissao
      $.get(rota, function(data){});
   });
   
   $(document).on('click', '.botao-permitir', function(e){
      e.preventDefault();
      
      var idPapel = $('#papel-combo').val();
      var idPermissao = $(this).data('permissao_id');
      
      var tr = $(this).parents('tr');
      var td = $(this).parent('td');
      var controle = tr.find('.bloqueado');
      
      controle.removeClass('bloqueado');
      controle.addClass('permitido');
      controle.text('sim');
      
      td.remove();
      tr.append("<td><a href='#' class='btn btn-danger botao-bloquear' data-permissao_id='"+idPermissao+"'>Bloquear</a></td>");
      
      var rota = rotaMudarPermissao('p', idPapel, idPermissao);
      
      //executa a rota que faz a mudança de permissao
      $.get(rota, function(data){});
   });
   
});
</script>
@endsection
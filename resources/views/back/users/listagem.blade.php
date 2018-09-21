<?php
   $nome_da_tela = "Listagem de usuários";
   $routePrefix = 'users';
   $campo_pesquisar = 'name';
   $place_hold_pesquisa = "Digite o nome para a pesquisa";
   
   $papelRepository = new \App\Domain\ControlAccess\PapelRepository();
?>

@extends('templates.admin')

@section('css')
<style>
   .botao-bloquear{
      /* Classe de marcação */
   }
</style>
@endsection

@section('content')
<h2 class='atividade'>{{$nome_da_tela}}</h2>
<hr id='linha-atividade'>
<div class='row'>
   <div class='col-md-5'>
      <form id='form-procurar' action="{{route($routePrefix.'.search')}}" method="post" class='form' role='form'>
         {!!csrf_field()!!}
         <input type='hidden' name='campo_pesquisar' value='{{$campo_pesquisar}}'>
         <div class="input-group">
            <input name='parametro' type="text" class="form-control" placeholder='{{$place_hold_pesquisa}}'>
            <span class="input-group-btn">
               <button class="btn btn-default" type="submit">
                  <span class="glyphicon glyphicon-search" aria-hidden="true"></span>Procurar
               </button>
            </span>
         </div><!-- /input-group -->
      </form>
   </div>
   <div class='col-md-1'>
      <a href="{{route($routePrefix.'.index')}}" class='btn btn-success'>Ver todos</a>
   </div>
   <div class='col-md-1'>
      <a id='botao-adicionar' href="{{route($routePrefix.'.create')}}" class='btn btn-primary'>Adicionar</a>
   </div>
</div>
<div class='row' style="margin-bottom: 20px;"></div>
<!--************************* TABELA COM A LISTAGEM ****************************************-->
{{$registros->links()}}
<div class='col-md-12'>
   @include('templates.erros')
   <div id='container-table' class='container col-md-12'>
      <table class='table'>
         <thead>
            <tr>
               <th>ID</th>
               <th>Nome</th>
               <th>Email</th>
               <th>Papel</th>
               <th class='text-center'>Operações</th>
            </tr>
         </thead>
         <tbody>
            @foreach($registros as $registro)
            <tr>
               @include('back.users.define-linhas')
            </tr>
            @endforeach	
         </tbody>
      </table>
   </div>
 </div>
{{$registros->links()}}
<!--************************** FIM DA TABELA COM A LISTAGEM **********************************-->

<!-- Modal para confirmação da exclusão de registro -->
<div class="modal fade" id="confirmaExclusao" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="controleModalLabel"><em>Confirmação de exclusão</em></h4>
      </div>
      <div class="modal-body">
        <p>Deseja realmente exluir esse cliente?</p>
        <div class='form-group'>
                <a id="botaoSimModalExcluir" href="#" class="btn btn-danger"data-dismiss="modal">Sim</a>
                <button type="button" class="btn btn-success" data-dismiss="modal">Não</button>
        </div>
      </div>
    </div>
  </div>
</div> <!-- Fim do modal -->

<!------- FORMULÁRIO PARA EXCLUSÃO DE REGISTRO -------------------->
<?php
use App\BaseApp\Presentions\Form;

Form::open([
    'id'=>'form_excluir',
    'method'=>'delete',
    'action'=>'#'
]);
Form::close();
?>
<!------- FINAL FORMULÁRIO PARA EXCLUSÃO DE REGISTRO -------------------->
@endsection

@section('script')
<script type="text/javascript">
var idExcluir;
$(document).ready(function(){
   $(".botaoExcluir").click(function(event){
      idExcluir = $(this).data('idexcluir');
   });

   $("#botaoSimModalExcluir").click(function(){
      var rota = "{{route($routePrefix.'.destroy',['id'=>'id-registro'])}}";
      rota = rota.replace('id-registro', idExcluir);

      $('#form_excluir').attr('action', rota);
      $('#form_excluir').submit();
   });
   
   $('.botao-bloquear').click(function(e){
      e.preventDefault();
      
      var user_id = $(this).data('user-id');
      var cadeado = '#cadeado_'+user_id;
      var botao_cadeado = $(this).find('i');
      var url = '{{route('users.block', ['id'=>'id_block'])}}';
      
      url = url.replace('id_block', user_id);
      
      if(botao_cadeado.hasClass('fa-lock')){
         $(this).addClass('btn-primary');
         botao_cadeado.addClass('fa-unlock-alt');
         botao_cadeado.removeClass('fa-lock');
         $(this).removeClass('btn-info');
         $(cadeado).css({'display':'inline'});
      } else{
         $(this).addClass('btn-info');
         botao_cadeado.addClass('fa-lock');
         botao_cadeado.removeClass('fa-unlock-alt');
         $(this).removeClass('btn-primary');
         $(cadeado).css({'display':'none'});
      }
      
      $.get(url);
   });
});
</script>
@endsection



@extends('templates.admin')

@section('css')
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
<div class='col-md-12'>
   @include('templates.erros')
   {{$registros->links()}}
   <div id='container-table' class='container col-md-12'>
      <table class='table'>
         <thead>
            <tr>
               <th>ID</th>
               @yield('th')
               <th class='text-center'>Operações</th>
            </tr>
         </thead>
         <tbody>
            @foreach($registros as $registro)
            <tr>
               <td>{{$registro->id}}</td>
               @include($td_path)
               <td class='text-center'>
                  <a href="{{route($routePrefix.'.edit',['permisoe'=>$registro->id])}}" class="btn btn-success">
                      <span class="glyphicon glyphicon-pencil" aria-hidden="false"></span>
                  </a>
                  <a href="#" class="btn btn-danger botaoExcluir" aria-label="Left Align" data-target="#confirmaExclusao"
                     title="Excluir categoria" data-toggle="modal" data-placement="bottom" tooltip
                     data-idExcluir="{{$registro->id}}">
                          <span class="glyphicon glyphicon-trash" aria-hidden="false"></span>
                  </a>
               </td>
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
});
</script>
@endsection
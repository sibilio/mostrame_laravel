@extends('Web.template')

@section('css')
<style >
   body{
      background-color: #f9f9f9;
   }   
</style>
@endsection

@section('content')
<div id="cabecalho-resultado" class="container-fluid">
   <div class="col-md-12">
      <div class="row">
         <div class="col-md-1">
            <img src="{{env("HTTP_BASE")}}/images/mostrame.png">
         </div>
         <div class="col-md-10">
            <form class="form" role="form" action="{{route('realiza-pesquisa')}}" method="get">
               {{csrf_field()}}
               <input type="hidden" name='regiao_id' value="{{$regiaoId}}">
               <input type="hidden" name='regiao_nome' value="{{$regiaoNome}}">
               <div class="col-md-6 col-md-offset-2">
                  <input type="text" class="form-control"
                         placeholder="Digite o que deseja pesquisar"
                         name="termo"
                         value="">
               </div>
               <div class="col-md-3">
                  <input id='submit-form' type="submit" class="btn btn-default" value="Procurar em {{$regiaoNome}}">
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<div id='content' class='container-fluid content-resultado'>
   <div class='col-md-12'>
      <?php
         /*esse trecho de código coloca para o primeiro registro mostrado de cada
          * prioridade para final da lista em sua prioridade
          */
         $prioridadeAtual = -1;
         foreach ($anunciantes as $anunciante):
            //mapeia campos necessários de forma correda
            
            $idDoAnunciante = $anunciante->anunciante_id ?? $anunciante->id;
            $nome = $anunciante->anunciante ?? $anunciante->nome;
            
            if($anunciante->prioridade != $prioridadeAtual || $prioridadeAtual == -1):
               $prioridadeAtual = $anunciante->prioridade;
               App\Domain\Anunciantes\PesquisaRepository::colocaNoFimDaLista($idDoAnunciante);
            endif;
      ?>
      <div class="quadro-anuncio">
         <p class="nome">{{$nome}}</p>
         <p>{{$anunciante->descricao}}</p>
         <p>{{$anunciante->endereco}}</p>
         <p>{{$anunciante->telefones}}</p>
         <p><a href="{{$anunciante->site}}">{{$anunciante->site}}</a></p>
      </div>
      <?php
         endforeach;
         //Prepara a barra de paginação
         $anunciantes->appends(['regiao_id'=>$regiaoId,
                              'regiao_nome'=>$regiaoNome,
                                    'termo'=>$termo])
                     ->links();
      ?>
   </div>
</div>
@endsection

@section('script')
<script>

</script>
@endsection
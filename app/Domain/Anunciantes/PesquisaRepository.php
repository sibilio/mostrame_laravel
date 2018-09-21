<?php
namespace App\Domain\Anunciantes;

use App\Anunciante;
use Sibilio\Sentence\Sentence;

class PesquisaRepository
{
   private $anunciosPorPagina;
   
   public function __construct($anunciosPorPagina=10)
   {
      $this->anunciosPorPagina = $anunciosPorPagina;
   }
   
   public function anuncios($_termos, $regiaoId)
   {
        $termos = Sentence::work($_termos);
        
        $anunciantes = $this->doSearch($termos, $regiaoId, false); //faz a pesquisa entre os anunciantes pagos
                        
        if(count($anunciantes) == 0) //Caso não tenha nenhuma anunciante pago
            $anunciantes = $this->doSearch($termos, $regiaoId, true); //faz a pesquisa entre os anunciantes gratuitos
                        
        return $anunciantes;
   }
   
   /**
    * Modifica o valor do campo mostrou de um anunciante colocando o timestamp do momento atual
    * dessa forma o anunciante mostrado na próxima vez que aparecer será mostrado no final da lista
    * @param integer $id identificador do registro que deseja enviar para o final da lista
    */
   static public function colocaNoFimDaLista($id)
   {
      $anunciante = Anunciante::find($id);
      if(count($anunciante)>0){
         $anunciante->mostrou = time();
         $anunciante->save();
      }
   }
   
   /**
    * Realiza a pesquisa dos anunciantes seguindo os parametros passados
    * @param type $termos Termos da pesquisa
    * @param type $regiaoId Região onde deve ser feita a pesquisa
    * @param type $gratuito Se o anunciante é do tipo pago ou gratuito
    * @return type
    */
   private function doSearch($termos, $regiaoId, $gratuito=false)
   {
       $anunciantes =  Anunciante
                         ::where('regiao_id', $regiaoId)
                         ->where('ativo', true)
                         ->where('gratuito', $gratuito)
                         ->where(function ($query) use ($termos){
                             $parametros = [];
                             foreach ($termos as $termo) {
                                 $parametros[] = ['palavras', 'like', "% $termo %"];
                             }
                             $query->where($parametros);
                         })
                         ->orderBy('prioridade')
                         ->orderBy('mostrou')
                         ->paginate($this->anunciosPorPagina);
       
       return $anunciantes;
   }
}

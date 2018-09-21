<?php
namespace App\BaseApp;

class BaseRepository
{
    private $model;
    
    public function __construct($model) {
        $this->model = $model;
    }
    public function create($requestData){
        try{
            $newRecord = $this->model::create($requestData);
            return $newRecord;
        } catch (Exception $ex) {
            return $this->formatException($ex);
        }
    }
    
    /**
     * Retorna o registro referente ao id passado.
     * @param type $id
     * @return boolean/Model Retorna o registro ou false caso não encontre
     */
    public function get($id){
        try
       {
         $record = $this->model::find($id);
         return $record;
            
        } catch (Exception $ex) {
            return false;
        }
    }
    
    public function delete($id){
        try {
            $record = $this->model::find($id);
            if($record == null){
                return response()->json([
                    'msg' => 'Registro não encontrado'
                ], 400);
            } else{
                $record->delete();
                return response()->json([
                    'msg' => 'Registro excluido com sucesso'
                ], 200);
            }
        } catch (Exception $ex) {
            return $this->formatException($ex);
        }
    }
    
    public function upDate($requestData){
        try {
            $record = $this->model::find($requestData['id']);
            if($record != null){
                return response()->json($record, 200);
            } else{
                return response()->json([
                    'msg'=>'Não foi possível atualizar o registro'
                ], 400);
            }
        } catch (Exception $ex) {
            return $this->formatException($ex);
        }
    }
    
    public function getAll($paginate=30){
        try {
            if($paginate == false){
               $records = $this->model::all();
            } else{
               $records = $this->model::paginate($paginate);
            }

            if($records != null){
               return $records;
            } else{
                return false;
            }
        } catch (Exception $ex) {
            return $this->formatException($ex);
        }
    }
    
    protected function formatException($ex)
    {
        return response()->json([
                'error' => $ex->getCode(),
                'msg' => $ex->getMessage()
            ], 400);
    }
    
   /**
    * Encontra um registro realizando uma pesquisa em um campo da tavela, utilizando o parâmetro valor para a pesquisa
    * @param type $campo Nome do campo que deseja pesquisar
    * @param type $valor Ocorrência que deseja que seja pesquisada no campo
    * @return Model Retorno o model encontrado ou NULL caso não encontre referência
    */
   public function where($campo, $valor)
   {
      return $this->model::where($campo, $valor)->first();
   }
   
   /**
    * Retorna uma coleção de um model com base em um critério de busca
    * @param string $campo Campo da tabela que deve ser pesquisado
    * @param string $criterio Critério da pesquisa
    * @param int $paginate Número de linhas para a paginação
    * @return Model
    */
   public function search($campo, $criterio, $paginate=30)
   {
      if($paginate == false){
         return $this->model::where($campo, 'like','%'.$criterio.'%')->get();
         
      } else{
         return $this->model::where($campo, 'like','%'.$criterio.'%')->paginate($paginate);
      }
   }
}
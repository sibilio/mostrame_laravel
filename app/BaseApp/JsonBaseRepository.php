<?php
namespace App\BaseApp;

class JsonBaseRepository
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
    
    public function get($id){
        try {
            $record = $this->model::find($id);
            if($record == null){
                return response()->json([
                    'msg' => 'Não foi possível localizar o registro.'
                ], 400);
            } else{
                return $record;
            }
        } catch (Exception $ex) {
            return $this->formatException($ex);
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
    
    public function getAll(){
        try {
            $records = $this->model::paginate(30);
            if($records != null){
               return response()->json($records, 200);
            } else{
                return response()->json([
                    'msg' => 'Não foram encontrados registros'
                ], 400);
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
    
    public function where($campo, $valor){
        try {
            $record = $this->model::where($campo, $valor)->first();
            if($record == null){
                return response()->json([
                    'msg' => 'Não foi possível localizar o registro.'
                ], 400);
            } else{
                return $record;
            }
        } catch (Exception $ex) {
            return $this->formatException($ex);
        }
    }
}
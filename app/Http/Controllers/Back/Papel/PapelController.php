<?php
namespace App\Http\Controllers\Back\Papel;

use App\BaseApp\BaseController;

class PapelController extends BaseController
{
   protected $viewPath = 'back.papeis';
   protected $routeNamePrefix = 'papeis';
   protected $model = 'App\Papel';
   protected $fieldSearch = 'descricao';
   protected $editMessage = 'Papel editado com sucesso!!!';
   protected $addMessage = 'Novo papel criado com sucesso!!!';
   protected $validateRoles = [
                  'descricao'=>'required|max:45|min:5'
             ];
   protected $crud = [
       'c'=>'create.papel',
       'r'=>'read.papel',
       'u'=>'update.papel',
       'd'=>'delete.papel'
   ];


   public function destroy($id) {
      $idPapeisQueNaoPodeExcluir = [1,2,3,4,5,6];
      
      if(in_array($id, $idPapeisQueNaoPodeExcluir)){
         return view('templates.sem-permissao');
      }
      
      $view = parent::destroy($id);
      
      return $view;
   }
}

<?php
namespace App\Http\Controllers\Back\Dados;

use App\BaseApp\BaseController;

class DadoController extends BaseController
{
   protected $viewPath = 'back.dados';
   protected $routeNamePrefix = 'dados';
   protected $model = 'App\Dado';
   protected $fieldSearch = 'chave';
   protected $editMessage = 'Chave de dados editada com sucesso!!!';
   protected $addMessage = 'Nova chave de dados criada com sucesso!!!';
   protected $validateRoles = [
                  'chave'=>'required|max:45|min:5',
                  'valor'=>'required|max:255|min:3'
             ];
   protected $crud = [
       'c'=>'create.dado',
       'r'=>'read.dado',
       'u'=>'update.dado',
       'd'=>'delete.dado'
   ];
}

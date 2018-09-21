<?php
namespace App\Http\Controllers\Back\Permissao;

use App\BaseApp\BaseController;

class PermissaoController extends BaseController
{
   protected $viewPath = 'back.permissoes';
   protected $routeNamePrefix = 'permissoes';
   protected $model = 'App\Permissao';
   protected $fieldSearch = 'tag';
   protected $editMessage = 'Permissão editada com sucesso!!!';
   protected $addMessage = 'Nova permissão criada com sucesso!!!';
   protected $validateRoles = [
                        'tag'=>'required|max:60|min:5',
                  'descricao'=>'required|max:255|min:5'
             ];
   protected $crud = [
       'c'=>'create.permissao',
       'r'=>'read.permissao',
       'u'=>'update.permissao',
       'd'=>'delete.permissao'
   ];
}

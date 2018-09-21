<?php
namespace App\Http\Controllers\Back\User;

use App\BaseApp\BaseController;
use App\BaseApp\BaseRepository;
use Illuminate\Support\Facades\Auth;

class UserController extends BaseController
{
   protected $viewPath = 'back.users';
   protected $routeNamePrefix = 'users';
   protected $model = 'App\User';
   protected $fieldSearch = 'nome';
   protected $editMessage = 'Usuário editado com sucesso!!!';
   protected $addMessage = 'Novo usuário criada com sucesso!!!';
   protected $validateRoles = [
                      'name'=>'required|max:150|min:5',
                     'email'=>'required|max:70|min:5',
                  'password'=>'required|max:70|min:6',
                  'papel_id'=>'required'
             ];
   protected $crud = [
       'c'=>'create.usuario',
       'r'=>'read.usuario',
       'u'=>'update.usuario',
       'd'=>'delete.usuario'
   ];
   
   public function destroy($id) {
      /**
       * O usuário de $id==1 é o usuário master-one root do sistema
       * nunca pode ser excluido
       */
      if($id === '1'){
         return view('templates.sem-permissao');
      }
      
      /**
       * Se o usuário que será excluido for master ou master-one
       * só pode ser excluido por um usuário master-one logado.
       */
      $user = $this->repository->get($id);
      if($user->papel_id === 1 || $user->papel_id === 2){
         if(Auth::user()->papel_id !== 1){
            return view('templates.sem-permissao');
         }
      }
      
      parent::destroy($id);
   }
   
   public function block($id)
   {
      try {
         $user = $this->repository->get($id);
         $user->bloqueado = !$user->bloqueado;
         $user->save();
         return ['resposta'=>true];
      } catch (Exception $exc) {
         return ['resposta'=>false];
      }
   }
}

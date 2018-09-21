<?php
namespace App\Domain\ControlAccess;

use App\BaseApp\BaseRepository;

class PapelRepository extends BaseRepository
{
   private $userRepository;
   
   public function __construct() {
      parent::__construct('App\Papel');
      
      $this->userRepository = new BaseRepository('App\User');
   }
   
   /**
    * Verifica se o id do papel que foi passado é master-one
    * @param integer $id
    */
   public function isMasterOne($id)
   {
      return ($id === 1);
   }
   
   /**
    * Verifica se o id do papel que foi passado é master
    * @param integer $id
    */
   public function isMaster($id)
   {
      return ($id === 2);
   }
}

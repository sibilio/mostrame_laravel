<?php
namespace App\BaseApp\Presentions\Combos;
use App\BaseApp\BaseRepository;
use Illuminate\Support\Facades\Auth;

class PapelCombo
{
   public static function doIt($value='')
   {
      $repository = new BaseRepository('App\Papel');
      $papeis = $repository->getAll(100);
      
      $html = "<select class='form-control' id='papel-combo' name='papel_id' style='width=100%;'>";
      
      foreach ($papeis as $key => $papel) {
         $html .= self::canCreateOption($papel, $value);
      }
      
      $html .= "</select>";
      
      return $html;
   }
   
   private static function canCreateOption($papel, $value)
   {
      $html = '';
      
      if($papel->id === 1 || $papel->id === 2){
         if(Auth::user()->papel_id === 1){
            $html .= self::createOption($papel, $value);
         }
      } else{
         $html .= self::createOption($papel, $value);
      }
      return $html;
   }
   
   private static function createOption($papel, $value){
      $html = "";
      
      if($value == $papel->id){
         $html = "<option value='$papel->id' selected>$papel->descricao</option>";
      } else{
         $html = "<option value='$papel->id'>$papel->descricao</option>";
      }
      return $html;
   }
}
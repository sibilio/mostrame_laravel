<?php
namespace App\Domain\ControlAccess;
use App\Dado as DadoModel;

/**
 * Classe helper para auxiliar a localizar e manter informações na tabela Dados
 */
class Dado
{
   /**
    * Recupera o valor de uma chave na tabela Dados
    * @param string $chave Chave a ser localizada
    * @return string Valor da chave
    */
   public static function get($chave)
   {
      $dado = DadoModel::where('chave', $chave)->first();
      return $dado->valor;
   }
   
   /**
    * 
    * @param string $chave Chave a ser modificada
    * @param string $valor Novo valor que deve ser atribuido a chave
    * @return string Novo valor da chave
    */
   public static function set($chave, $valor)
   {
      $dado = DadoModel::where('chave', $chave)->first();
      $dado->valor = $valor;
      $dado-save();
      
      return $dado->valor;
   }
}

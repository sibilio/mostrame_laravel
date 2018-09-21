<?php
namespace App\BaseApp\Upload;

use Carbon\Carbon;

Class Upload
{
   /**
    *
    * @var string Nome da imagem sem o caminho.
    */
   private $fileName;
   private $directory;
   
   public function __construct($file, $directory=null)
   {
      $this->directory = $directory ?? storage_path('public/upload');
      $this->makeUpload($file);
   }
   
   /**
    * 
    * @param file $file Recebe o arquivo para upload e a grava no disco, renomeando da forma correta.
    */
   private function makeUpload($file)
   {
      $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
      $nameWithoutSpace = str_replace(" ", "_", $file->getClientOriginalName());
      $name = $timestamp. '-' .$nameWithoutSpace;
      $this->fileName = $name;
      \info($this->directory.'/'.$this->fileName);
      $file->move($this->directory, $name);
   }
   
   public function imageName()
   {
      return $this->fileName;
   }
   
}
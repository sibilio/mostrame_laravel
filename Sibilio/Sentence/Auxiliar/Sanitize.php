<?php
namespace Sibilio\Sentence\Auxiliar;

class Sanitize
{
    public static function doIt($arraySentence)
    {
        $arraySentencaDeRetorno = [];
        
        $arraySentence = self::lowerCase($arraySentence);
        
        //É necessário escapar usando \ os seguintes caracteres:
        //[]\^$.?*|+{}'",/_-
        //Todos os caracteres acima possuem função em uma regex por isso o escape
        $caracteresEspeciais = "\[\]\\\^\$\.\?\*\|\+\{\}\,\'\"\/\_\-";
        //Adicionamos os outros caracteres especiais que não precisam de escape
        $caracteresEspeciais .= "!@#%&=~;%():";
        $caracteresEspeciais = '/['.$caracteresEspeciais.']/ui';
        
        $regras = [
            "/[ãàáâä]/ui", "/[éêẽèë]/ui", "/[íìîĩï]/ui", "/[ôõóòö]/ui", "/[úùûũü]/ui", "/[ç]/ui",
            $caracteresEspeciais
        ];
        
        $sub = [
            "a", "e", "i" , "o", "u", "c", ""
        ];
        
        foreach ($arraySentence as $sentence)
            $arraySentencaDeRetorno[] = preg_replace($regras, $sub, $sentence);
        
        return $arraySentencaDeRetorno;
    }
    
    public static function lowerCase($arraySentence)
    {
        $arraySentenceRetorno = [];
        foreach ($arraySentence as $sentence)
            $arraySentenceRetorno[] = strtolower($sentence);
        
        return $arraySentenceRetorno;
    }
    
    public static function removeElementoVazio($array)
    {
        $novoArray = [];
        foreach ($array as $key => $elemento){
            if($elemento != "")
                $novoArray[] = $elemento;
        }
        
        return $novoArray;
    }
    
}

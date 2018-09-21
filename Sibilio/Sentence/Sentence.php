<?php
namespace Sibilio\Sentence;

use Sibilio\Sentence\Auxiliar\Sanitize;
use Sibilio\Sentence\Auxiliar\StopWords;



/**
 * Classe estatica que recebe uma sentença (frase) e remove as stop words, passa tudo para <br>
 * passa tudo para minúsculo e remove acentos e caracteres especiais 
 * @author marcos
 *
 */
class Sentence
{
    public static function work($sentence)
    {
        $arraySentence = StopWords::stop($sentence);
        
        $arraySentence = Sanitize::lowerCase($arraySentence);
        $arraySentence = Sanitize::doIt($arraySentence);
        $arraySentence = Sanitize::removeElementoVazio($arraySentence);
        
        return $arraySentence;        
    }
}


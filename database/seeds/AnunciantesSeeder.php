<?php

use Illuminate\Database\Seeder;
use App\Anunciante;
use Sibilio\Sentence\Sentence;

class AnunciantesSeeder extends Seeder
{

    private $anunciantes;
    private $conjuntoPalavras;
    
    public function __construct()
    {
        $dir = "/home/marcos/workspace/projetos/mostrame/base de dados/cadastros"; //caminho local
        //$dir = "/home/mostrame/mostrame/storage/app"; //Caminho no servidor web
        $this->anunciantes = require_once "$dir/anunciantes_peruibe.php";
        $this->conjuntoPalavras = require_once "$dir/conjunto_de_palavras.php";
    }
    
    public function run()
    {
        foreach ($this->anunciantes as $anunciante) {
            //define as palavras pelas quais o anunciante será encontrado
            $palavras = " ";
            
            if(count($anunciante['conjunto']) > 0){
                foreach ($anunciante['conjunto'] as $conjunto) {
                    foreach ($this->conjuntoPalavras[$conjunto] as $palavra) {
                        $palavras .= "$palavra ";
                    }
                }
            }
            
            if(count($anunciante['palavras']) > 0){
                foreach ($anunciante['palavras'] as $palavra){
                    $palavras .= "$palavra ";
                }
            }
            
            $nomes = Sentence::work($anunciante['nome']);
            foreach ($nomes as $nome) {
                $palavras .= "$nome ";
            }
            
            $palavras = str_replace("  ", " ", $palavras);
            $this->criaAnunciante($anunciante, $palavras);
        }
        
        $anunciante = Anunciante::where("nome", 'like', 'Rodrilar%')->first();
        $anunciante->gratuito = false;
        $anunciante->save();
    }
    
    private function criaAnunciante($anunciante, $palavras)
    {
        //cria novo anunciante
        $novoAnunciante = new Anunciante();
        $novoAnunciante->nome = $anunciante['nome'];
        $novoAnunciante->regiao_id = 1;
        $novoAnunciante->prioridade = 5;
        $novoAnunciante->descricao = $anunciante['descricao'];
        $novoAnunciante->endereco = $anunciante['endereco'];
        $novoAnunciante->palavras = $palavras;
        $novoAnunciante->telefones = $anunciante['telefones'];
        $novoAnunciante->mostrou = time()+30;
        $novoAnunciante->site = $anunciante['site'];
        $novoAnunciante->save();
    }
}

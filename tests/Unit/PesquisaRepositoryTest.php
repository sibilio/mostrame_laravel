<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Domain\Anunciantes\PesquisaRepository;
use App\Anunciante;
use Sibilio\Sentence\Sentence;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PesquisaRepositoryTest extends TestCase
{
    public function testAnuncios()
    {
        $termo = "material para decoração";
        
        $anunciantesEsperado = Anunciante::where('regiao_id', 1)
                                         ->where('palavras', 'like', '% material %')
                                         ->where('palavras', 'like', '% decoracao %')
                                         ->paginate(10);
        
        $pesquisaRepository = new PesquisaRepository();
        $anunciantesAtual = $pesquisaRepository->anuncios($termo, 1);
        
        $this->assertEquals($anunciantesAtual, $anunciantesEsperado);
    }
}

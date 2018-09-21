<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BaseApp\BaseRepository;
use App\Domain\Anunciantes\PesquisaRepository;

class PesquisaController extends Controller
{
   public $regiaoRepository;
   public $pesquisaRepository;
   
   public function __construct()
   {
      $this->regiaoRepository = new BaseRepository('App\Regiao');
      $this->pesquisaRepository = new PesquisaRepository();
   }
   public function index($_regiao)
    {
       $regiao = $this->regiaoRepository->get($_regiao);
       return view('Web.pesquisa')
                  ->with('regiao', $regiao);
    }
    
    public function realizaPesquisa(Request $request)
    {
       $resultado = '';
       
       $resultado = $this->pesquisaRepository->anuncios($request['termo'], $request['regiao_id']);
             

       return view('Web.resultado')
                  ->with('anunciantes', $resultado)
                  ->with('regiaoId',$request['regiao_id'])
                  ->with('regiaoNome', $request['regiao_nome'])
                  ->with('termo', $request['termo']);
    }
    
}

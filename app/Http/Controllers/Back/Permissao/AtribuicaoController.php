<?php

namespace App\Http\Controllers\Back\Permissao;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BaseApp\BaseRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AtribuicaoController extends Controller
{
   private $permissaoRepository;
   private $papelRepository;
   
   public function __construct()
   {
      $this->permissaoRepository = new BaseRepository('App\Permissao');
      $this->papelRepository = new BaseRepository('App\Papel');
   }
   
   public function index()
   {
      if(Auth::user()->canDoIt('read.atribuicao')){
         return view('back.permissoes.atribuicao.listagem');
      } else{
         return view('templates.sem-permissao');
      }
   }
   
   public function selecionarPapel($papel_id)
   {
      if(Auth::user()->cantDoIt('read.atribuicao')){
         return view('templates.sem-permissao');
      }
      
      $permissoes = $this->permissaoRepository->getAll(false);
      $permissoesPapel = DB::table('permissoes_papeis')
                           ->select('permissao_id')
                           ->where('papel_id', $papel_id)
                           ->get();
      
      return view('back.permissoes.atribuicao.listagem')
               ->with('permissoes', $permissoes)
               ->with('permissoesPapel', $permissoesPapel)
               ->with('papel_id', $papel_id);
   }
   
   public function mudarPermissao($operacao, $papel_id, $permissao_id)
   {
      if(Auth::user()->cantDoIt('update.atribuicao')){
         return view('templates.sem-permissao');
      }
      
      if($operacao == 'b'){//b=bloquear, retira d papel essa permissao
         DB::table('permissoes_papeis')
                 ->where('papel_id', $papel_id)
                 ->where('permissao_id', $permissao_id)
                 ->delete();
      } elseif($operacao == 'p'){//p=permitir, cadastra na tabela permissoes_papeis essa permissao
         DB::table('permissoes_papeis')->insert([
             'permissao_id'=>$permissao_id,
             'papel_id'=>$papel_id
         ]);
      }
      return redirect()->route('atribuicoes.selecionar-papel', ['papel_id', $papel_id]);
   }
}

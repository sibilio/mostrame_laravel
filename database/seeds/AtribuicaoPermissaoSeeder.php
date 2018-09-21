<?php

use Illuminate\Database\Seeder;
use App\Permissao;
use Illuminate\Support\Facades\DB;
use App\BaseApp\BaseRepository;

class AtribuicaoPermissaoSeeder extends Seeder
{
   private $permissaoRepository;
   
   public function __construct()
   {
      $this->permissaoRepository = new BaseRepository('App\Permissao');
   }
   
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $papeis = [
            [
                'id'=>2,
                'descricao'=>'master',
                'permissoes'=>[
                    'acessa.adm-background',
                    'create.usuario',
                    'read.usuario',
                    'update.usuario',
                    'delete.usuario',
                    'menu.usuario',
                    'menu.master',
                    'menu.master.dados',
                    'create.dado',
                    'read.dado',
                    'update.dado',
                    'delete.dado',
                    'bloquear.usuario',
                ]
            ],
            [
                'id'=>3,
                'descricao'=>'administrador',
                'permissoes'=>[
                    'acessa.adm-background',
                    'create.usuario',
                    'read.usuario',
                    'update.usuario',
                    'delete.usuario',
                    'menu.usuario',
                    'bloquear.usuario',
                ]
            ],
            [
                'id'=>4,
                'descricao'=>'gerente',
                'permissoes'=>[
                    'acessa.adm-background',
                ]
            ],
            [
                'id'=>5,
                'descricao'=>'operador',
                'permissoes'=>[
                    'acessa.adm-background',
                ]
            ],
            [
                'id'=>6,
                'descricao'=>'cliente',
                'permissoes'=>[]
            ],
        ];
        
        $this->atrbuiPermissoesMaster();
        $this->atribuiAsOutrasPermissoes($papeis);
    }
    
    private function atrbuiPermissoesMaster()
    {
       $masterId = 1;
       $permissoes = Permissao::all();
       
       foreach ($permissoes as $permissao) {
          DB::table('permissoes_papeis')->insert([
              'papel_id' => $masterId,
              'permissao_id' => $permissao->id
          ]);
       }
    }
    
    private function atribuiAsOutrasPermissoes(Array $papeis)
    {
       foreach ($papeis as $papel) {
           foreach ($papel['permissoes'] as $tag) {
               DB::table('permissoes_papeis')->insert([
                 'papel_id' => $papel['id'],
                 'permissao_id' => $this->getPermissaoId($tag)
               ]);
           }
        }
       
    }
    
    /**
     * Recebe a tag de uma permissão e devolve seu id.
     * @param string $tag
     * @return integer
     */
    private function getPermissaoId($tag)
    {
       return $this->permissaoRepository->where('tag', $tag)->id;
    }
}

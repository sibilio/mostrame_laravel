<?php

use Illuminate\Database\Seeder;
use App\Permissao;

class PermissoesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $permissoes = [
         $this->newPermission('read.atribuicao', 'Permite ao usuário visualizar as atribuições de permissão dos usuários.'),
         $this->newPermission('update.atribuicao', 'Permite ao usuário editar as atribuições de permissão dos usuários.'),
         $this->newPermission('acessa.adm-background', 'Permite ao usuário acessar o bacjground administrativo.'),
         $this->newPermission('create.permissao', 'Permite ao usuário adicionar nova permissão ao sistema.'),
         $this->newPermission("read.permissao", "Permite ao usuário recuperar (ver) permissões."),  
         $this->newPermission("update.permissao", "Permite ao usuário editar permissões."),  
         $this->newPermission("delete.permissao", "Permite ao usuário excluir permissões."),  
         $this->newPermission('create.papel', 'Permite ao usuário adicionar novo papel ao sistema.'),
         $this->newPermission("read.papel", "Permite ao usuário visualizar papel."),  
         $this->newPermission("update.papel", "Permite ao usuário editar papel."),  
         $this->newPermission("delete.papel", "Permite ao usuário excluir papel."),  
         $this->newPermission('create.usuario', 'Permite ao usuário adicionar novo usuario ao sistema.'),
         $this->newPermission("read.usuario", "Permite ao usuário visualizar usuários."),  
         $this->newPermission("update.usuario", "Permite ao usuário editar usuários."),  
         $this->newPermission("delete.usuario", "Permite ao usuário excluir usuários."),  
         $this->newPermission("menu.usuario", "Permite ao usuário excluir usuários."),  
         $this->newPermission('create.usuario.master', 'Permite ao usuário adicionar novo usuario master ao sistema.'),
         $this->newPermission("read.usuario.master", "Permite ao usuário visualizar usuários master."),
         $this->newPermission("update.usuario.master", "Permite ao usuário editar usuários master."),  
         $this->newPermission("delete.usuario.master", "Permite ao usuário excluir usuários master."),  
         $this->newPermission("menu.master", "Permite ao usuário visualizar o menu master"),
         $this->newPermission("menu.master.permissoes", "Permite ao usuário visualizar o menu master"),
         $this->newPermission("menu.master.papeis", "Permite ao usuário visualizar o menu master"),
         $this->newPermission("menu.master.atribuicao", "Permite ao usuário visualizar o menu master"),
         $this->newPermission("menu.master.dados", "Permite ao usuário visualizar o menu master"),
         $this->newPermission('create.dado', 'Permite ao usuário adicionar novo usuario master ao sistema.'),
         $this->newPermission("read.dado", "Permite ao usuário visualizar usuários master."),
         $this->newPermission("update.dado", "Permite ao usuário editar usuários master."),  
         $this->newPermission("delete.dado", "Permite ao usuário excluir usuários master."),
         $this->newPermission("bloquear.usuario", "Permite que o usuário logado bloqueie outro usuário."),
       ];
       
       foreach ($permissoes as $permissao){
          $novaPermissao = new Permissao();
          $novaPermissao->tag = $permissao['tag'];
          $novaPermissao->descricao = $permissao['descricao'];
          $novaPermissao->save();
       }
    }
    
    private function newPermission($tag, $descricao)
    {
       return[
         'tag'=>$tag,
         'descricao'=>$descricao
       ];
    }
}

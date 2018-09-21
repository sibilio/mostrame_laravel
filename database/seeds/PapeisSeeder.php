<?php

use Illuminate\Database\Seeder;
use App\Papel;

class PapeisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $papeis = ['master-one', 'master', 'administrador', 'gerente', 'operador', 'cliente'];

        foreach ($papeis as $papel) {
           $novoPapel = new Papel();
           $novoPapel->descricao = $papel;
           $novoPapel->save();
        }
    }
}

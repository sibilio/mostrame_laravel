<?php

use Illuminate\Database\Seeder;
use App\Regiao;

class RegioesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $regiao = new Regiao();
        $regiao->cidade_id = 1;
        $regiao->user_id = 1;
        $regiao->nome = "Peruibe";
        $regiao->nome_no_site = "Peruibe";
        $regiao->save();
    }
}

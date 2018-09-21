<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersSeeder::class);
        $this->call(PermissoesSeeder::class);
        $this->call(PapeisSeeder::class);
        $this->call(AtribuicaoPermissaoSeeder::class);
        $this->call(DadosSeeder::class);
        $this->call(CidadesSeeder::class);
        $this->call(RegioesSeeder::class);
        $this->call(AnunciantesSeeder::class);
    }
}

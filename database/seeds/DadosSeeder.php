<?php

use Illuminate\Database\Seeder;
use App\Dado;

class DadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayDados=[
                  ['chave'=>'nome fantasia', 'valor'=>''],
                  ['chave'=>'razo social', 'valor'=>''],
                  ['chave'=>'cnpj', 'valor'=>''],
                  ['chave'=>'inscricao', 'valor'=>''],
                  ['chave'=>'endereco', 'valor'=>''],
                  ['chave'=>'bairro', 'valor'=>''],
                  ['chave'=>'uf', 'valor'=>''],
                  ['chave'=>'cep', 'valor'=>''],
                  ['chave'=>'telefone1', 'valor'=>''],
                  ['chave'=>'telefone2', 'valor'=>''],
                  ['chave'=>'empresa bloqueada', 'valor'=>'não'],
        ];
        
        foreach ($arrayDados as $ad){
           $dado = new Dado();
           $dado->chave = $ad['chave'];
           $dado->valor = $ad['valor'];
           $dado->save();
        }
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class CreateAnunciantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anunciantes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 45);
            $table->integer('regiao_id');
            $table->integer('prioridade');
            $table->text('descricao');
            $table->text('endereco');
            $table->text('palavras');
            $table->string('telefones', 255);
            $table->bigInteger('mostrou');
            $table->string('site', 255)->nullable();
            $table->boolean('ativo')->default(true);
            $table->boolean('gratuito')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anunciantes');
    }
}

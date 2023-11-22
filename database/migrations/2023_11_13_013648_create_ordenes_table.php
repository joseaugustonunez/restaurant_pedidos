<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('ordenes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario_id')->nullable(); 
            $table->foreign('usuario_id')->references('id')->on('users');
            $table->json('carrito');
            $table->integer('cantidad');
            $table->unsignedBigInteger('mesas_id');
            $table->foreign('mesas_id')->references('id')->on('mesas');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ordenes');
    }
};

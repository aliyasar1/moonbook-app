<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siparis_detaylari', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->autoIncrement();
            $table->unsignedBigInteger('siparis_id');
            $table->unsignedBigInteger('kitap_id');
            $table->integer('miktar');
            $table->timestamps();

            $table->foreign('siparis_id')->references('id')->on('siparisler')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('kitap_id')->references('id')->on('kitaplar')
                ->onDelete('cascade')->onUpdate('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siparis_detaylari');
    }
};

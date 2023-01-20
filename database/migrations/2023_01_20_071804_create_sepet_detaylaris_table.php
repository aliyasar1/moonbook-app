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
        Schema::create('sepet_detaylari', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->autoIncrement();
            $table->unsignedBigInteger('sepet_id');
            $table->unsignedBigInteger('kitap_id');
            $table->integer('miktar');
            $table->timestamps();

            $table->foreign('sepet_id')->references('id')->on('sepetler')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('kitap_id')->references('id')->on('kitaplar')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sepet_detaylaris');
    }
};

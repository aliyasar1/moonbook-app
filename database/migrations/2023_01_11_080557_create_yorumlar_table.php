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
        Schema::create('yorumlar', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->autoIncrement();
            $table->unsignedBigInteger('kitap_id');
            $table->unsignedBigInteger('kullanici_id');
            $table->longText('yorum');
            $table->timestamps();

            $table->foreign('kitap_id')->references('id')->on('kitaplar')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('kullanici_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('yorumlar');
    }
};

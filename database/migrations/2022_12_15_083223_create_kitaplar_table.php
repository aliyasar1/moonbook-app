<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kitaplar', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->autoIncrement();
            $table->string('fotograf')->default('book.png');
            $table->unsignedBigInteger('kategori_id');
            $table->string('adi');
            $table->unsignedBigInteger('yazar_id');
            $table->unsignedBigInteger('yayin_evi_id');
            $table->string('sayfa_sayisi')->nullable();
            $table->string('yayin_yili')->nullable();
            $table->longText('aciklama')->nullable();
            $table->string('puan')->nullable();
            $table->integer('fiyat')->default(0);
            $table->timestamps();

            $table->foreign('kategori_id')->references('id')->on('kategoriler')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('yazar_id')->references('id')->on('yazarlar')->onDelete('cascade')->onDelete('cascade');
            $table->foreign('yayin_evi_id')->references('id')->on('yayin_evleri')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kitaplar');
    }
};

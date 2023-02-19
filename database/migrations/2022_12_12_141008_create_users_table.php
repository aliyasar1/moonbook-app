<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->autoIncrement();
            $table->enum('type', ['admin', 'user'])->default('user');
            $table->string('fotograf')->default(Storage::url('default.png'));
            $table->string('firma_adi')->unique()->nullable();
            $table->string('tckn')->unique()->nullable();
            $table->string('adi_soyadi');
            $table->string('kullanici_adi')->unique();
            $table->string('tel_no')->unique();
            $table->string('email')->unique();
            $table->string('sifre');
            $table->string('sifre_tekrar');
            $table->string('adres');
            $table->unsignedBigInteger('ilce_id');
            $table->unsignedBigInteger('il_id');
            $table->timestamps();

            $table->foreign('il_id')
                ->references('id')
                ->on('iller')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('ilce_id')
                ->references('id')
                ->on('ilceler')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};

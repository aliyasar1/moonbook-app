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
        Schema::table('sepet_detaylari', function (Blueprint $table) {
            $table->decimal('fiyat', 19)
                ->after('miktar')
                ->default(0)
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sepet_detaylari', function (Blueprint $table) {
            $table->dropColumn('fiyat');
        });
    }
};

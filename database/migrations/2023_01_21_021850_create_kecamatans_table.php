<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKecamatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kecamatan', function (Blueprint $table) {
            $table->integer('id_kecamatan', 11);
            $table->string('nama_kecamatan', 100);
            $table->string('geojson', 100)->nullable();
            $table->string('nama_var')->nullable();
            $table->string('lang',)->nullable();
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
        Schema::dropIfExists('kecamatans');
    }
}

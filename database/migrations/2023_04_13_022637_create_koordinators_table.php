<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKoordinatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('koordinator', function (Blueprint $table) {
            $table->integer('id_koordinator', 11);
            $table->integer('id_kecamatan');
            $table->integer('id_user');
            $table->string('nama', 100);
            $table->string('nik', 16);
            $table->string('alamat', 100);
            $table->string('email', 100);
            $table->string('no_hp', 12);
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
        Schema::dropIfExists('koordinator');
    }
}

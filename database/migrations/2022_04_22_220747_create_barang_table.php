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
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->string('nama',30);
            $table->string('spesifikasi',30)->nullable();
            $table->string('lokasi',30)->nullable();
            $table->string('kategori',20)->nullable();
            $table->integer('jumlah')->default(0);
            $table->string('ukuran',10)->nullable();
            $table->string('berat')->nullable();
            $table->string('foto')->nullable();
            $table->integer('hargaBeli')->nullable();
            $table->integer('hargaJual')->nullable();
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
        Schema::dropIfExists('barang');
    }
};

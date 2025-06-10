<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('buku_tamu', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->time('waktu');
            $table->string('foto')->nullable();
            $table->string('nama');
            $table->string('instansi');
            $table->string('telepon');
            $table->text('tujuan');
            $table->string('ttd')->nullable();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('buku_tamu');
    }
};



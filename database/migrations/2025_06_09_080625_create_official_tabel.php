<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('officials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('position');
            $table->string('rank')->nullable();
            $table->string('nip')->nullable();
            $table->string('department');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('officials');
    }
};

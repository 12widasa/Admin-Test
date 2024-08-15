<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
Schema::create('products', function (Blueprint $table) {
    $table->id();  // This creates an 'id' column with type 'bigint unsigned'
    $table->string('nama');
    $table->string('foto');
    $table->integer('stok_sekarang')->default(0);
    $table->timestamps();
});

    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};

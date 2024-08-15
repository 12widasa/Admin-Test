<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
Schema::create('input_stocks', function (Blueprint $table) {
    $table->id();
    $table->foreignId('product_id')->constrained()->onDelete('cascade');
    $table->integer('penambahan_stok');
    $table->datetime('tanggal_input');
    $table->timestamps();
});
    }

    public function down()
    {
        Schema::dropIfExists('InputStock');
    }
};
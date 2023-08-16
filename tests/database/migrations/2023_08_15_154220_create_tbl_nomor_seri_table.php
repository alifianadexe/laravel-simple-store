<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblNomorSeriTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_nomor_seri', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->string('serial_no', 256);
            $table->integer('price')->nullable();
            $table->date('prod_date')->nullable();
            $table->date('warranty_start')->nullable();
            $table->date('warranty_duration')->nullable();
            $table->integer('used')->default(0);
            $table->timestamps();
            
            $table->foreign('product_id', 'barang_nomor_seri_id_foreign')->references('id')->on('tbl_barang')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_nomor_seri');
    }
}

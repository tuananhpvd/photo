<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHoadonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hoadons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lop_id');
            $table->foreign('lop_id')->references('id')->on('lops');
            $table->date('ngay');
            $table->text('gvbm');
            $table->text('noidung');
            $table->unsignedBigInteger('giay_id');
            $table->foreign('giay_id')->references('id')->on('giays');
            $table->integer('sotrang');
            $table->integer('soluong');
            $table->text('ghichu')->nullable();             
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
        Schema::dropIfExists('hoadons');
    }
}

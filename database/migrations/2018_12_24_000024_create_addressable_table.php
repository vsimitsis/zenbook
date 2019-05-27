<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addressables', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('address_id');
            $table->foreign('address_id')
                ->references('id')
                ->on('addresses')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->morphs('addressable');
            $table->boolean('default')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addressables');
    }
}

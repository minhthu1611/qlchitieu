<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChitieungayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chitieungay', function (Blueprint $table) {
            $table->increments('id');
            $table->string('chitieu');
            $table->double('giatri');
            $table->string('ngaythang');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')
            ->references('id')->on('user')
            ->onDelete('cascade');
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
        Schema::dropIfExists('chitieungay');
    }
}

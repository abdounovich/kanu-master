<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('facebook');
            $table->text('ActiveType');
            $table->text('fb_id');
            $table->text('jour');
            $table->text('debut');
            $table->text('fin');

            $table->unsignedBigInteger('type_id');
            $table->foreign('type_id')
            ->references('id')->on('types')
            ->onDelete('cascade');
            
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')
            ->references('id')->on('clients')
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
        Schema::dropIfExists('appointments');
    }
}

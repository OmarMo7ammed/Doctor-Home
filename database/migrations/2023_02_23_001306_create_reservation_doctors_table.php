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
        Schema::create('reservation_doctors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('Doctor_Id');
            $table->unsignedBigInteger('Patient_Id')->nullable();
            $table->string('Photo_National_ID');
            $table->bigInteger('Price')->nullable();
            $table->dateTime('Date')->nullable();
            $table->boolean('Status')->default(false);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });

        Schema::table('reservation_doctors', function (Blueprint $table) {

            $table->foreign('Patient_Id')->references('id')->on('patients')->onDelete('cascade');
            $table->foreign('Doctor_Id')->references('id')->on('doctors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservation_doctors' ,function($table) 
        {
        
            $table->DropForeign('Patient_Id');
            $table->DropForeign('Doctor_Id');

        });
    }
};

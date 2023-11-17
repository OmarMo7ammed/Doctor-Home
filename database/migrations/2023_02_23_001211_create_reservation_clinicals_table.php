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
        Schema::create('reservation_clinicals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('Clinical_Id')->nullable();
            $table->unsignedBigInteger('Patient_Id')->nullable();
            $table->unsignedBigInteger('Work_Days_Id')->nullable();
            $table->boolean('Status')->default(false);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });


        Schema::table('reservation_clinicals', function (Blueprint $table) {

            $table->foreign('Clinical_Id')->references('id')->on('clinicals')->onDelete('cascade');
            $table->foreign('Patient_Id')->references('id')->on('patients')->onDelete('cascade');
            $table->foreign('Work_Days_Id')->references('id')->on('work_days')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservation_clinicals' ,function($table) 
        {
        
            $table->DropForeign('Clinical_Id');
            $table->DropForeign('Patient_Id');
            $table->DropForeign('Work_Days_Id');

        });
}
};


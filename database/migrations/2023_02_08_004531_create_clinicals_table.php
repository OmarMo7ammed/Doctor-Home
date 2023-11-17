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
        Schema::create('clinicals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Clinical_Name')->index();
            $table->string('Photo')->nullable();
            $table->string('Photo_Work_Permit');
            $table->string('Name_Department');
            $table->string('Address');
            $table->double('Latitude')->nullable();
            $table->double('Longitude')->nullable();
            $table->text('Details');
            $table->bigInteger('Phone_Number');
            $table->bigInteger('Service_Price');
            $table->boolean('Acceptance')->default(false);
            $table->boolean('Acceptance_Edit')->default(True);
            $table->unsignedBigInteger('Doctor_Id');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();


        });


        
        Schema::table('clinicals', function (Blueprint $table) {
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
        Schema::dropIfExists('clinicals',function ($table){

        $table->DropForeign('Doctor_Id');
    });
    }
};

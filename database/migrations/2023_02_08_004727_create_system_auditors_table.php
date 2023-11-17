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
        Schema::create('system_auditors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('Clinical_Id')->nullable();
            $table->unsignedBigInteger('Doctor_Id')->nullable();
            $table->unsignedBigInteger('User_Id')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            
        });
        
        Schema::table('system_auditors', function (Blueprint $table) {
            $table->foreign('Clinical_Id')->references('id')->on('clinicals')->onDelete('cascade');
            $table->foreign('Doctor_Id')->references('id')->on('doctors')->onDelete('cascade');
            $table->foreign('User_Id')->references('id')->on('users')->onDelete('cascade');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('system_auditors' ,function($table) 
        {
            $table->DropForeign('Clinical_Id');
            $table->DropForeign('Doctor_Id');
            $table->DropForeign('User_Id');
        });   
    }
};

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
        Schema::create('patients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('PName')->index();
            $table->string('Photo')->nullable();
            $table->string('Address');
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->bigInteger('Phone_Number');
            $table->bigInteger('Age');
            $table->string('Gender');
            $table->unsignedBigInteger('User_Id')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
        Schema::table('patients', function (Blueprint $table) {

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
        Schema::dropIfExists('patients' ,function($table) 
        {
            $table->DropForeign('User_Id');
        });   
    }
};

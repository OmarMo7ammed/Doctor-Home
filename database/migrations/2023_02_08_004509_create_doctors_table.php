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
        Schema::create('doctors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('DName')->index();
            $table->string('Photo')->nullable();
            $table->string('Photo_National_ID');
            $table->string('Photo_Work_Permit');
            $table->string('Photo_Doctors_Syndicate');
            $table->bigInteger('Years_Exp');
            $table->bigInteger('Doctor_Ssn');
            $table->text('Description');
            $table->bigInteger('Phone_Number');
            $table->string('Name_Department');
            $table->bigInteger('Age');
            $table->string('Gender');
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable(); 
            $table->unsignedBigInteger('User_Id')->nullable();
            $table->string('Service_Price')->nullable();
            $table->boolean('Acceptance')->default(false);
            $table->boolean('Acceptance_Edit')->default(True);
            $table->boolean('Status')->default(false);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });

        Schema::table('doctors', function (Blueprint $table) {

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
        Schema::dropIfExists('doctors' ,function($table) 
        {
            $table->DropForeign('User_Id');
        });
    }
};

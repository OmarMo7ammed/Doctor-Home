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
        Schema::create('work_days', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('Clinical_Id')->nullable();
            $table->time('From_Time');
            $table->time('To_Time');
            $table->date('Day');
            $table->tinyInteger('Status')->default(0);
            /* Days: 0=>sat, 1=>sun, 2=>mon, 3=>tue, 4=>wed, 5=>thu, 6=>fri */
            $table->bigInteger('Patient_Number');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });

        Schema::table('work_days', function (Blueprint $table) {

            $table->foreign('Clinical_Id')->references('id')->on('clinicals')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('work_days', function($table) 
        {
            
            $table->DropForeign('Clinical_Id');
        
        });
    }
};

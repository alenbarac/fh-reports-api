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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('user_id')->nullable()->constrained();
            $table->foreignId('waterbody_id')->constrained('waterbodies');
            $table->string('column_value_1')->nullable();
            $table->string('column_value_2')->nullable();
            $table->string('column_value_3')->nullable();
            $table->string('column_value_4')->nullable();
            $table->string('column_value_5')->nullable();
            $table->string('column_value_6')->nullable();
            $table->string('column_value_7')->nullable();
            $table->string('column_value_8')->nullable();
            $table->string('column_value_9')->nullable();
            $table->string('column_value_10')->nullable();
            $table->string('column_value_11')->nullable();
            $table->string('column_value_12')->nullable();
           
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
        Schema::dropIfExists('reports');
    }
};
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
        Schema::create('provinces', function (Blueprint $table) {
            $table->id();
            $table->string('province_name');
            $table->boolean('is_active')->default(true);

            $table->string('column_label_1')->nullable();
            $table->string('column_label_2')->nullable();
            $table->string('column_label_3')->nullable();
            $table->string('column_label_4')->nullable();
            $table->string('column_label_5')->nullable();
            $table->string('column_label_6')->nullable();
            $table->string('column_label_7')->nullable();
            $table->string('column_label_8')->nullable();
            $table->string('column_label_9')->nullable();
            $table->string('column_label_10')->nullable();
            $table->string('column_label_11')->nullable();
            $table->string('column_label_12')->nullable();
            
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
        Schema::dropIfExists('provinces');
    }
};
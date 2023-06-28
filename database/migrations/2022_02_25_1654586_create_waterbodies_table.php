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
        Schema::create('waterbodies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('region_id')->constrained();
            $table->string('waterbody_name');
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->string('created_email')->nullable()->default("dev@commer.com");
            $table->string('created_name')->nullable()->default("admin@commer.com");
            $table->text('waterbody_report')->nullable();

            $table->boolean('waterbody_unlisted')->default(false);

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
        Schema::dropIfExists('waterbodies');
    }
};
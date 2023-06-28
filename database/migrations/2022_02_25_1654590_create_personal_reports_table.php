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
        Schema::create('personal_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('waterbody_id')->constrained('waterbodies');
            $table->string('poster_name')->nullable();
            $table->string('poster_email')->nullable();
            $table->text('poster_message')->nullable();
            $table->boolean('report_approved')->default(false);
            $table->date('report_date')->nullable()->default(null);

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
        Schema::dropIfExists('personal_reports');
    }
};
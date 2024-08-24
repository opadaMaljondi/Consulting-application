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
        Schema::create('excpert-day', function (Blueprint $table) {
            $table->id();
            $table->foreignId('excpert_id');
            $table->foreignId('day_id');
            $table->string(column:'From');
            $table->string(column:'to');
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
        Schema::dropIfExists('dateues');
    }
};

// database/migrations/2024_02_14_000003_create_availability_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('availability', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('barber_id');
            $table->string('day');
            $table->time('startTime');
            $table->time('endTime');
            $table->timestamps();
            
            $table->foreign('barber_id')->references('id')->on('barbers')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('availability');
    }
};
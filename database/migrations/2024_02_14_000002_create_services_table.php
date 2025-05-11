// database/migrations/2024_02_14_000002_create_services_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('barber_id');
            $table->string('serviceName');
            $table->text('description')->nullable();
            $table->double('price');
            $table->integer('duration');
            $table->timestamps();
            
            $table->foreign('barber_id')->references('id')->on('barbers')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('services');
    }
};
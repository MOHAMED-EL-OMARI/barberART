// database/migrations/2024_02_14_000001_create_barbers_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('barbers', function (Blueprint $table) {
            $table->id();
            $table->text('bio')->nullable();
            $table->integer('experience')->nullable();
            $table->string('location')->nullable();
            $table->boolean('verified')->default(false);
            $table->timestamps();
            
            $table->foreign('id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('barbers');
    }
};
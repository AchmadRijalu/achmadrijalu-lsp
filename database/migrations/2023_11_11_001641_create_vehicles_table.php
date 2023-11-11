<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string("model");
            $table->bigInteger("year");
            $table->bigInteger("passenger_count");
            $table->string("manufacture");
            $table->string('photo')->nullable();
            $table->bigInteger("price");
            $table->unsignedBigInteger('vehicleable_id')->nullable();
            $table->string('vehicleable_type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};

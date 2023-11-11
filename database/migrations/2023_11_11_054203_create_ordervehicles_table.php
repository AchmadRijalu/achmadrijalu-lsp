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
        Schema::create('order_vehicles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger("vehicle_id");
            $table->unsignedBigInteger("order_id");
            $table->foreign("order_id")->references("id")->on("orders")->onDelete('cascade')->onUpdate('cascade');
            $table->foreign("vehicle_id")->references("id")->on("vehicles")->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger("order_count");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordervehicles');
    }
};

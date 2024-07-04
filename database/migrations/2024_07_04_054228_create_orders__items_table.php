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
        Schema::create('orders_items', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->foreigUuid("order_id");
            $table->foreignUuid("food_id");
            $table->integer("qty");
            $table->timestamps();
            $table->foreign("order_id")->references("id")->on("orders")->onDelete("cascade");
            $table->foreign("food_id")->references("id")->on("foods")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders__items');
    }
};

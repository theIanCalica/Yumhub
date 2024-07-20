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
        Schema::create('foods', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string("name");
            $table->text("desc");
            $table->decimal("price");
            $table->foreignUuid("restaurant_id");
            $table->foreignUuid("cuisine_id");
            $table->foreignUuid("food_id");
            $table->longText("filePath");
            $table->timestamps();
            $table->foreign("food_id")->references("id")->on("foods")->onDelete("cascade");
            $table->foreign("restaurant_id")->references("id")->on("restaurants")->onDelete("cascade");
            $table->foreign("cuisine_id")->references("id")->on("cuisines")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food');
    }
};

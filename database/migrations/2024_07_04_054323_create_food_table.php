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
        Schema::create('food', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string("name");
            $table->text("desc");
            $table->decimal("price");
            $table->foreignUuid("seller_id");
            $table->foreignUuid("cuisine_id");
            $table->timestamps();
            $table->foreign("seller_id")->references("id")->on("sellers")->onDelete("cascade");
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

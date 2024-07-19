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
        Schema::create('restaurants', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->foreignUuid("owner_id");
            $table->string("name", 255);
            $table->text("address");
            $table->string("phoneNumber", 11);
            $table->string("email");
            $table->string("logo_filePath");
            $table->longText("desc");
            $table->string("operatingHours");
            $table->timestamps();
            $table->foreign("owner_id")->references("id")->on("users")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurants');
    }
};

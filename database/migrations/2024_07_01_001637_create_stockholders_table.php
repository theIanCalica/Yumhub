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
        Schema::create('stockholders', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string("name", 255);
            $table->string("sex", 6);
            $table->date("dob");
            $table->string("email");
            $table->string("phoneNumber", 11);
            $table->string("address");
            $table->integer("sharesOwned");
            $table->date("investmentDate");
            $table->string("prefferedContact");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stockholders');
    }
};

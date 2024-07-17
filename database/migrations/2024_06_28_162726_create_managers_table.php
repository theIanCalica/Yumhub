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
        Schema::create('managers', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string("fname");
            $table->string("lname");
            $table->string("sex");
            $table->dateTime("DOB");
            $table->string("phoneNumber", 11);
            $table->string("email");
            $table->dateTime("hiredDate");
            $table->string("employmentStatus");
            $table->string("salary");
            $table->string("address");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('managers');
    }
};

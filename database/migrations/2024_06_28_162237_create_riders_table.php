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
        Schema::create('riders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string("fname");
            $table->string("lname");
            $table->string("SEX");
            $table->date("DOB");
            $table->string("phoneNumber", 11);
            $table->string("email");
            $table->date("hired-date");
            $table->string("employment-status");
            $table->string("salary");
            $table->string("address");
            $table->string("motor-model");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riders');
    }
};

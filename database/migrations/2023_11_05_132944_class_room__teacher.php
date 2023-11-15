<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('classRoom_Teacher', function (Blueprint $table) {
            $table->uuid('teacherId')->primary();
            $table->string('name');
            $table->string('icNumber');
            $table->string('noTell');
            $table->string('email');
            $table->boolean('isClassTeacher');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classRoom_Teacher');
    }
};

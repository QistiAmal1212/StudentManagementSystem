<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('class_room_teacher', function (Blueprint $table) {
            $table->uuid('teacher_id')->primary();
            $table->string('name');
            $table->string('ic_number');
            $table->string('no_tell');
            $table->string('email');
            $table->boolean('is_class_teacher');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_room_teacher');
    }
};

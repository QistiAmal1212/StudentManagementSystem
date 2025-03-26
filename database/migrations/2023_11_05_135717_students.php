<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->uuid('studentId')->primary();
            $table->string('name');
            $table->string('icNumber');
            $table->string('noTell');
            $table->string('email');
            $table->decimal('family_income ', 10, 2);
            $table->integer('total_family_member');
            $table->timestamps();

            $table->uuid('classroomId');
            $table->foreign('classroomId')
                  ->references('classroomId')
                  ->on('classRoom')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->uuid('student_id')->primary();
            $table->string('name');
            $table->string('ic_number');
            $table->string('no_tell');
            $table->string('email');
            $table->decimal('family_income', 10, 2);
            $table->integer('total_family_member');
            $table->timestamps();

            $table->uuid('classroom_id');
            $table->foreign('classroom_id')
                  ->references('classroom_id')
                  ->on('classroom')
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

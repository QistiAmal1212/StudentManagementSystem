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
        Schema::create('student_result', function (Blueprint $table) {
            $table->uuid('resultId')->primary();
            $table->string('name');
            $table->string('status');
            $table->string('icNumber');
            $table->string('className');
            $table->float('average', 8, 2)->nullable();
            $table->string('Bahasa_Melayu')->nullable();
            $table->string('English')->nullable();
            $table->string('Math')->nullable();
            $table->string('Science')->nullable();
            $table->string('Sejarah')->nullable();
            $table->timestamps();


            $table->uuid('examId'); 
            $table->foreign('examId')
                  ->references('examId')
                  ->on('exam')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

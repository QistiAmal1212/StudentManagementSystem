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
            $table->uuid('result_id')->primary();
            $table->string('name');
            $table->string('status');
            $table->string('ic_number');
            $table->string('class_name');
            $table->float('average', 8, 2)->nullable();
            $table->string('bahasa_melayu')->nullable();
            $table->string('english')->nullable();
            $table->string('math')->nullable();
            $table->string('science')->nullable();
            $table->string('sejarah')->nullable();
            $table->timestamps();


            $table->uuid('exam_id');
            $table->foreign('exam_id')
                  ->references('exam_id')
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

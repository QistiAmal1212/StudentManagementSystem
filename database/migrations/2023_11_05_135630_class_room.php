<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('classRoom', function (Blueprint $table) {
            $table->uuid('classroomId')->primary();
            $table->string('className');
            $table->integer('form');
            $table->timestamps();

              $table->uuid('teacherId');
              $table->foreign('teacherId')
                    ->references('teacherId')
                    ->on('classRoom_Teacher')
                    ->onDelete('cascade');
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('classRoom');
    }
};

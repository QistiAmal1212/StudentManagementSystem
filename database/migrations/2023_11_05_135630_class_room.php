<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('class_room', function (Blueprint $table) {
            $table->uuid('class_room_id')->primary();
            $table->string('class_name');
            $table->integer('form');
            $table->timestamps();

              $table->uuid('teacher_id');
              $table->foreign('teacher_id')
                    ->references('teacher_id')
                    ->on('class_room_teacher')
                    ->onDelete('cascade');
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('class_room');
    }
};

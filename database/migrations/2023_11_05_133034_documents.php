<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('document', function (Blueprint $table) {
            $table->id('document_id');
            $table->string('document_path');
            $table->string('title')->nullable();
            $table->timestamps();


        });
    }


    public function down(): void
    {
        Schema::dropIfExists('document');
    }
};

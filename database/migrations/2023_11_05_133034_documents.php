<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('document', function (Blueprint $table) {
            $table->id('documentId');
            $table->string('documentPath');
            $table->string('title')->nullable();
            $table->timestamps();
            
          
        });
    }

   
    public function down(): void
    {
        Schema::dropIfExists('document');
    }
};
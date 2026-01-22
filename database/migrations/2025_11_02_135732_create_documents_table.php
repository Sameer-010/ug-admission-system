<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('application_id')->constrained()->onDelete('cascade');
            $table->enum('document_type', [
                'photo',
                'cnic',
                'matric_certificate',
                'inter_certificate',
                'domicile'
            ]);
            $table->string('file_name');
            $table->string('file_path');
            $table->string('file_size'); // in KB
            $table->string('mime_type');
            $table->boolean('is_verified')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
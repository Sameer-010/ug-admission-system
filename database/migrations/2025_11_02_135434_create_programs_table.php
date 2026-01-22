<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., "BS Information Technology"
            $table->string('code')->unique(); // e.g., "BSIT"
            $table->text('description')->nullable();
            $table->integer('duration_years')->default(4);
            $table->integer('total_seats')->default(50);
            $table->date('application_start_date')->nullable();
            $table->date('application_end_date')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};
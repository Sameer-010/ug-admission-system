<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('program_id')->constrained()->onDelete('cascade');
            
            // Personal Information
            $table->string('father_name');
            $table->string('father_cnic');
            $table->string('father_occupation')->nullable();
            $table->date('date_of_birth');
            $table->enum('gender', ['male', 'female', 'other']);
            $table->string('domicile');
            
            // Academic Information
            $table->string('matric_board');
            $table->string('matric_roll_no');
            $table->integer('matric_total_marks');
            $table->integer('matric_obtained_marks');
            $table->decimal('matric_percentage', 5, 2);
            $table->integer('matric_passing_year');
            
            $table->string('inter_board');
            $table->string('inter_roll_no');
            $table->integer('inter_total_marks');
            $table->integer('inter_obtained_marks');
            $table->decimal('inter_percentage', 5, 2);
            $table->integer('inter_passing_year');
            
            // Application Status
            $table->enum('status', [
                'draft',
                'submitted',
                'under_review',
                'approved',
                'rejected',
                'waitlisted'
            ])->default('draft');
            
            $table->text('admin_comments')->nullable();
            $table->timestamp('submitted_at')->nullable();
            $table->timestamp('reviewed_at')->nullable();
            $table->foreignId('reviewed_by')->nullable()->constrained('users');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
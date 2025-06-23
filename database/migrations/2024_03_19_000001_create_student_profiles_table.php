<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            
            // Personal Information
            $table->text('about_me')->nullable();
            $table->string('full_name');
            $table->string('nik', 16)->unique();
            $table->string('birth_place');
            $table->date('birth_date');
            $table->text('address');
            $table->string('email')->unique();
            $table->string('phone');
            
            // Academic Information
            $table->json('education_history')->nullable();
            $table->json('work_experience')->nullable();
            $table->json('licenses_certifications')->nullable();
            $table->json('awards')->nullable();
            $table->json('skills')->nullable();
            
            // Family Information
            $table->json('family_data')->nullable();
            
            // Documents
            $table->string('cv_path')->nullable();
            $table->string('transcript_path')->nullable();
            $table->string('id_card_path')->nullable();
            $table->string('certificate_path')->nullable();
            $table->string('cover_letter_path')->nullable();
            
            // Profile Completion
            $table->integer('completion_percentage')->default(0);
            $table->boolean('is_profile_complete')->default(false);
            $table->boolean('is_ready_for_internship')->default(false);
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_profiles');
    }
}; 
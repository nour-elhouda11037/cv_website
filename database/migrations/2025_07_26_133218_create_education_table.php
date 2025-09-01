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
        Schema::create('education', function (Blueprint $table) {
            $table->id();
            $table->foreignId('resume_id')->constrained('resumes')->onDelete('cascade');
            $table->string('school_name');
            $table->string('degree');
            $table->date('edu_start');
            $table->date('edu_end')->nullable();
            $table->text('edu_desc')->nullable();
            $table->timestamps();});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education');
    }
};

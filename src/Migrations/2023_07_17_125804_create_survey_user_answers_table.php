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
        Schema::create('survey_user_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('survey_question_option_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('survey_question_id')->nullable()->constrained()->onDelete('set null');

            $table->text('answer')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('survey_user_answers');
    }
};
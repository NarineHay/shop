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
        Schema::create('portfolio_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('portfolio_id')->constrained()->cascadeOnDelete();
            $table->string('locale', 2); // ru, hy, en
            $table->string('name');
            $table->string('slug');
            $table->longText('description');
            $table->longText('technologies');
            $table->timestamps();

            $table->unique(['locale', 'slug'], 'portfolio_translations_locale_slug_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolio_translations');
    }
};

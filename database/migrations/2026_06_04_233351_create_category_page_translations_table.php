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
        Schema::create('category_page_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_page_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('locale', 2);

            // баннер
            $table->string('banner_title')->nullable();
            $table->text('banner_text')->nullable();

            // контент страницы
            $table->string('page_title')->nullable();
            $table->longText('content')->nullable();

            $table->timestamps();

            $table->unique(['category_page_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_page_translations');
    }
};

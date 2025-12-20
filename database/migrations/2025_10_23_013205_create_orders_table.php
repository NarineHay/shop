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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('info_customer_id')->nullable()->constrained()->nullOnDelete();

            $table->string('status')->default('new');
            $table->string('number')->unique();

            // $table->integer('subtotal');
            // $table->integer('shipping')->default(0);
            // $table->integer('tax')->default(0);
            // $table->integer('discount')->default(0);
            $table->integer('total');
            $table->mediumText('comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

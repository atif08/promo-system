<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('sku');
            $table->string('asin', 40)->nullable();
            $table->string('parent_asin', 40)->nullable();
            $table->text('title')->nullable();
            $table->text('category')->nullable();
            $table->text('link')->nullable();
            $table->text('image_thumbnail')->nullable();
            $table->unsignedDouble('listing_price')->default(0);

            $table->timestamps();

            $table->unique(['user_id', 'sku']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('products');
    }
};

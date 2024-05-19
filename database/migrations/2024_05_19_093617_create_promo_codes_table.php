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
        Schema::create('promo_codes', function (Blueprint $table) {
            $table->id();
//            $table->foreignId('user_id')
//                ->constrained('users')
//                ->cascadeOnDelete();
            $table->string('promo_code')->unique()->comment('Promo code name in capital letters with gender type');
            $table->integer('usage_limit');
            $table->enum('gender', ['male', 'female'])->comment('Gender type associated with the promo code');
            $table->enum('type', ['flat', 'percent']);
            $table->date('start_date')->comment('Start date of the promo code validity');
            $table->date('end_date')->comment('End date of the promo code validity');
            $table->decimal('amount', 8, 2)->comment('Maximum discount amount as a flat amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promo_codes');
    }
};

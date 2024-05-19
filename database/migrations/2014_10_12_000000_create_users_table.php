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
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->date('dob');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();

            $table->boolean('is_active')->default(0);
            $table->string('user_type')->nullable();

            $table->foreignId('parent_id')->nullable();
            $table->foreign('parent_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->string('seller_id')->nullable();
            $table->foreignId('marketplace_id')->nullable();
            $table->string('region_code', 2)->nullable();
            $table->string('profile_id')->nullable();

            $table->string('delete_status')->nullable();
            $table->timestamp('last_activity_at')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

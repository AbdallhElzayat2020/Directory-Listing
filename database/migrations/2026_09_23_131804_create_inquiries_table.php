<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('listing_id')->constrained('listings')->cascadeOnDelete();

            $table->foreignId('owner_id')->nullable()->constrained('users')->cascadeOnDelete();

            $table->foreignId('sender_id')->nullable()->constrained('users')->cascadeOnDelete();

            $table->string('name');
            $table->string('email');
            $table->string('phone', 20);
            $table->string('subject');

            $table->boolean('is_read')->default(false);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inquiries');
    }
};

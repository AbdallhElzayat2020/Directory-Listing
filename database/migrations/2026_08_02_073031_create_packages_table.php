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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->enum('package_type', ['free', 'paid']);
            $table->string('name', 255);
            $table->string('slug', 255)->unique();
            $table->decimal('price', 10, 2);
            $table->text('description')->nullable();
            $table->integer('number_of_days')->default(0);
            $table->integer('number_of_listings')->default(0);
            $table->integer('number_of_photos')->default(0);
            $table->integer('number_of_videos')->default(0);
            $table->integer('number_of_amenities')->default(0);
            $table->integer('number_of_featured_listings')->default(0);
            $table->enum('is_featured', ['yes', 'no'])->default('yes');
            $table->enum('show_at_home', ['yes', 'no'])->default('yes');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};

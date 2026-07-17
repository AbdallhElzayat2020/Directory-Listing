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
        Schema::create('listings', function (Blueprint $table) {
            // restrictOnDelete if there are any
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('category_id')->constrained('categories')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('location_id')->constrained('locations')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('package_id')->nullable(); // nullable
            $table->string('image');
            $table->string('thumbnail_image');
            $table->string('title', 255);
            $table->string('slug', 255)->unique();
            $table->longText('description');
            $table->string('phone', 20);
            $table->string('email', 255);
            $table->text('address');
            $table->text('website')->nullable();
            $table->text('facebook_link', 255)->nullable();
            $table->text('x_link', 255)->nullable();
            $table->text('instagram_link', 255)->nullable();
            $table->text('linkedin_link', 255)->nullable();
            $table->text('whatsapp_link', 255)->nullable();
            $table->text('google_map_embed_code')->nullable();
            $table->integer('views')->default(0);
            $table->string('attachments')->nullable();
            $table->date('expired_date');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->enum('is_verified', ['yes', 'no'])->default('no');
            $table->enum('is_featured', ['yes', 'no'])->default('no');
            // seo
            $table->string('seo_title', 255)->nullable();
            $table->string('seo_description', 255)->nullable();

            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};

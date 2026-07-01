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
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone', 20)->unique()->nullable()->after('email');
            $table->string('address', 255)->nullable()->after('password');
            $table->text('website')->nullable()->after('address');
            $table->string('facebook_link', 255)->nullable()->after('website');
            $table->string('x_link', 255)->nullable()->after('facebook_link');
            $table->string('whatsapp', 255)->nullable()->after('x_link');
            $table->string('linkedin_link', 255)->nullable()->after('whatsapp');
            $table->string('instagram_link', 255)->nullable()->after('linkedin_link');
            $table->text('about')->nullable()->after('instagram_link');
            $table->string('banner')->default('/default_avatar/breadcroumb_bg.jpg')->after('avatar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};

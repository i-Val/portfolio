<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->string('facebook_url')->nullable()->after('twitter_url');
            $table->string('instagram_url')->nullable()->after('facebook_url');
            $table->string('youtube_url')->nullable()->after('instagram_url');
            $table->string('dribbble_url')->nullable()->after('youtube_url');
            $table->string('google_plus_url')->nullable()->after('dribbble_url');
            $table->boolean('maintenance_enabled')->default(false)->after('google_plus_url');
            $table->text('maintenance_message')->nullable()->after('maintenance_enabled');
        });
    }

    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn([
                'facebook_url',
                'instagram_url',
                'youtube_url',
                'dribbble_url',
                'google_plus_url',
                'maintenance_enabled',
                'maintenance_message',
            ]);
        });
    }
};

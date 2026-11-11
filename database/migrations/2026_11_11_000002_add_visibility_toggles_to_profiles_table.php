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
        Schema::table('profiles', function (Blueprint $table) {
            $table->boolean('show_birthdate')->default(true);
            $table->boolean('show_name')->default(true);
            $table->boolean('show_headline')->default(true);
            $table->boolean('show_phone')->default(true);
            $table->boolean('show_location')->default(true);
            $table->boolean('show_email')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn([
                'show_birthdate',
                'show_name',
                'show_headline',
                'show_phone',
                'show_location',
                'show_email',
            ]);
        });
    }
};

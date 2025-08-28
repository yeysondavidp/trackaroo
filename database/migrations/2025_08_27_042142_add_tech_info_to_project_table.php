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
        Schema::table('projects', function (Blueprint $table) {

            $table->text('comments')->after('description')->nullable();
            $table->json('start_photos')->after('expected_date')->nullable();
            $table->time('start_time')->after('start_photos')->nullable();
            $table->string('start_gps')->after('start_time')->nullable();
            $table->json('finish_photos')->after('start_gps')->nullable();
            $table->time('finish_time')->after('finish_photos')->nullable();
            $table->string('finish_gps')->after('finish_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn([
                'comments',
                'start_photos',
                'start_time',
                'start_gps',
                'finish_photos',
                'finish_time',
                'finish_gps',
            ]);
        });
    }
};

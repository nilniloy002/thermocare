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
        Schema::table('navigation_items', function (Blueprint $table) {
        Schema::table('navigation_items', function (Blueprint $table) {
            $table->foreignId('parent_id')->nullable()->constrained('navigation_items')->nullOnDelete()->after('id');
            $table->string('menu_type')->default('link')->after('location');
        });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('navigation_items', function (Blueprint $table) {
        Schema::table('navigation_items', function (Blueprint $table) {
            $table->dropConstrainedForeignId('parent_id');
            $table->dropColumn('menu_type');
        });
        });
    }
};

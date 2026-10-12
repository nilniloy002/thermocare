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
            $table->string('menu_group')->nullable()->after('menu_type');
            $table->string('description')->nullable()->after('url');
            $table->string('icon')->nullable()->after('description');
            $table->string('promo_title')->nullable()->after('icon');
            $table->text('promo_text')->nullable()->after('promo_title');
            $table->string('promo_button_label')->nullable()->after('promo_text');
            $table->string('promo_button_url')->nullable()->after('promo_button_label');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('navigation_items', function (Blueprint $table) {
            $table->dropColumn(['menu_group', 'description', 'icon', 'promo_title', 'promo_text', 'promo_button_label', 'promo_button_url']);
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        foreach (['dhaka_map_url' => 'https://maps.app.goo.gl/KGV55hPUsXz2Km6T6', 'chattogram_map_url' => ''] as $key => $value) {
            if (! DB::table('site_settings')->where('key', $key)->exists()) {
                DB::table('site_settings')->insert(['key' => $key, 'value' => $value, 'group' => 'general']);
            }
        }
    }

    public function down(): void
    {
        // Keep administrator-managed map links when rolling back.
    }
};

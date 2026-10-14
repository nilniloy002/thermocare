<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        foreach ([
            'address' => 'House-2B, (3rd Floor), Road-08, Nikunja-02, Dhaka-1229, Bangladesh',
            'chattogram_address' => '79/A Matro Plaza (5th Floor), Sadarghat Kalibari Moor, Chattogram.',
            'contact_email' => 'thermocarebd@gmail.com',
            'phone' => '+88 01828 009 393',
            'phone_secondary' => '+88 01711 714 740',
        ] as $key => $value) {
            DB::table('site_settings')->updateOrInsert(['key' => $key], ['value' => $value, 'group' => 'general']);
        }
    }

    public function down(): void
    {
        // Preserve administrator-managed contact information on rollback.
    }
};

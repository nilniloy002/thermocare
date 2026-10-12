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
        Schema::table('enquiries', function (Blueprint $table) {
        Schema::table('enquiries', function (Blueprint $table) {
            $table->string('enquiry_type')->default('contact')->after('id');
            $table->string('project_type')->nullable()->after('service_interest');
            $table->string('location')->nullable()->after('project_type');
        });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('enquiries', function (Blueprint $table) {
        Schema::table('enquiries', function (Blueprint $table) {
            $table->dropColumn(['enquiry_type', 'project_type', 'location']);
        });
        });
    }
};

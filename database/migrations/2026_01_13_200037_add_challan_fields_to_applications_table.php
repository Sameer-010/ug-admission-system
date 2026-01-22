<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->string('challan_number')->nullable()->after('status');
            $table->string('challan_pdf')->nullable();
            $table->string('challan_paid_copy')->nullable();
            $table->enum('challan_status', ['pending', 'paid', 'verified'])
                  ->default('pending');
        });
    }

    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn([
                'challan_number',
                'challan_pdf',
                'challan_paid_copy',
                'challan_status',
            ]);
        });
    }
};

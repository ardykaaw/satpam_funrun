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
        Schema::table('registrations', function (Blueprint $table) {
            $table->string('barcode')->nullable()->after('registration_number');
            $table->boolean('race_pack_picked_up')->default(false)->after('barcode');
            $table->timestamp('race_pack_picked_up_at')->nullable()->after('race_pack_picked_up');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->dropColumn(['barcode', 'race_pack_picked_up', 'race_pack_picked_up_at']);
        });
    }
};

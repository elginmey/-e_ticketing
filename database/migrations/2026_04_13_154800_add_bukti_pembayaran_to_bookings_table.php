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
        if (! Schema::hasColumn('bookings', 'bukti_pembayaran')) {
            Schema::table('bookings', function (Blueprint $table) {
                $table->string('bukti_pembayaran')->nullable();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('bookings', 'bukti_pembayaran')) {
            Schema::table('bookings', function (Blueprint $table) {
                $table->dropColumn('bukti_pembayaran');
            });
        }
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('penjualan', function (Blueprint $table) {
            $table->integer('jumlah_bayar')->default(0)->after('total_pembayaran');
            $table->integer('kembalian')->default(0)->after('jumlah_bayar');
        });
    }

    public function down(): void
    {
        Schema::table('penjualan', function (Blueprint $table) {
            $table->dropColumn(['jumlah_bayar', 'kembalian']);
        });
    }
};
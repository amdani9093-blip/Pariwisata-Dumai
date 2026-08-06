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
    Schema::table('destinasi', function (Blueprint $table) {
        $table->integer('harga_tiket')->default(0)->after('lokasi');
    });
}
 
public function down(): void
{
    Schema::table('destinasi', function (Blueprint $table) {
        $table->dropColumn('harga_tiket');
    });
}

};

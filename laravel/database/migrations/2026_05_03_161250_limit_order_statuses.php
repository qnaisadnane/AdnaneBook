<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Convert any existing shipped/delivered orders to paid to avoid data loss
        DB::table('orders')->whereIn('status', ['shipped', 'delivered'])->update(['status' => 'paid']);
        
        // Modify the ENUM column
        DB::statement("ALTER TABLE orders MODIFY COLUMN status ENUM('pending', 'paid') NOT NULL DEFAULT 'pending'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE orders MODIFY COLUMN status ENUM('pending', 'paid', 'shipped', 'delivered') NOT NULL DEFAULT 'pending'");
    }
};

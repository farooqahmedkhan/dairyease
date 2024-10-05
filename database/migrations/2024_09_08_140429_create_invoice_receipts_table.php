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
        if(!Schema::hasTable('invoice_receipts')) {
            Schema::create('invoice_receipts', function (Blueprint $table) {
                $table->id();
                
                $table->foreignId('invoice_id')->constrained()->cascadeOnDelete();
                $table->foreignId('delivery_item_id')->constrained()->cascadeOnDelete();

                $table->decimal('quantity', 15, 8);
                $table->decimal('price', 15, 8);
                $table->decimal('discount', 15, 8)->default(0);
                
                $table->boolean('exclude')->default(false);

                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_receipts');
    }
};

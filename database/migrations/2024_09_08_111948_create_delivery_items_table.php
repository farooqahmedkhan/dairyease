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
        if(!Schema::hasTable('delivery_items')) {
            Schema::create('delivery_items', function (Blueprint $table) {
                $table->id();
                $table->foreignId('subscription_delivery_id')->constrained()->cascadeOnDelete();
                $table->foreignId('subscription_item_id')->constrained()->cascadeOnDelete();

                $table->decimal('quantity', 15, 8);
                $table->enum('unit', ['GRAM', 'KILOGRAM', 'LITRE']);
                $table->enum('status', ['UNDER_DELIVERED', 'OVER_DELIVERED', 'FULL_DELIVERED']);

                $table->string('notes', 500);

                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_items');
    }
};

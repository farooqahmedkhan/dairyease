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
        if(!Schema::hasTable('subscription_deliveries')) {
            Schema::create('subscription_deliveries', function (Blueprint $table) {
                $table->id();
                
                $table->foreignId('subscription_id')->constrained()->cascadeOnDelete();
                
                $table->date('planned_date');
                $table->datetime('delivered_date')->nullable();
                
                $table->enum('status', ['PENDING', 'DELIVERED', 'CANCELLED'])->default('PENDING');
                
                $table->string('notes', 500)->nullable();
                
                $table->foreignId('cancel_reason_id')->constrained()->nullable();
                
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_deliveries');
    }
};

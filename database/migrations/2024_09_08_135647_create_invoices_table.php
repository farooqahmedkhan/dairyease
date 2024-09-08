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
        if(!Schema::hasTable('invoices')) {
            Schema::create('invoices', function (Blueprint $table) {
                $table->id();

                $table->date('date');
                $table->date('due_date');
                
                $table->foreignId('subscription_id')->constrained()->cascadeOnDelete();
                
                $table->decimal('total_amount', 15, 8);
                $table->decimal('discount', 15, 8)->default(0);
                $table->decimal('paid_amount', 15, 8)->nullable();
                $table->decimal('tax', 15, 8)->default(0);
                $table->enum('currency', ['PKR'])->default('PKR');

                $table->unsignedBigInteger('customer_id');
                $table->foreign('customer_id')->references('id')->on('users');
                
                $table->unsignedBigInteger('provider_id');
                $table->foreign('provider_id')->references('id')->on('users');

                $table->enum('status', ['PENDING', 'REVIEW', 'SENT', 'PAID', 'EXPORT'])->default('PENDING');

                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};

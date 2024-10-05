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
        if(!Schema::hasTable('subscriptions')) {
            Schema::create('subscriptions', function (Blueprint $table) {
                $table->id();
                
                $table->string('name')->comment('Subscription name, able to identify for a customer / provider');
                
                $table->date('start_date');
                $table->date('end_date');
                
                $table->boolean('active')->default(true);
                $table->enum('payment_method', ['CASH', 'MOBILE_WALLET', 'BANK_TRANSFER'])->default('CASH');
                
                $table->unsignedBigInteger('customer_id');
                $table->foreign('customer_id')->references('id')->on('users');
                
                $table->unsignedBigInteger('provider_id');
                $table->foreign('provider_id')->references('id')->on('users');

                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};

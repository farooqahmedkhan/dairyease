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
        if(!Schema::hasTable('subscription_schedules')) {
            Schema::create('subscription_schedules', function (Blueprint $table) {
                $table->id();
                
                $table->string('name')->comment('A user can later alter it\'s subscription schedule if he want on different days');
                
                $table->enum('day', ['MONDAY', 'TUESDAY', 'WEDNESDAY', 'THURSDAY', 'FRIDAY', 'SATURDAY', 'SUNDAY']);
                
                $table->string('start_time');
                $table->string('end_time');

                $table->foreignId('subscription_id')->constrained()->cascadeOnDelete();
                
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_schedules');
    }
};

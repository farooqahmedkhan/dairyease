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
        if(!Schema::hasTable('notifications')) {
            Schema::create('notifications', function (Blueprint $table) {
                $table->id();
                
                $table->foreignId('user_id')->constrained()->cascadeOnDelete();

                $table->enum('type', ['REMINDER', 'ALERT'])->default('ALERT');

                $table->string('title');
                $table->string('body')->nullable();

                $table->enum('status', ['GENERATED', 'SENT', 'DELIVERED', 'READ'])->default('GENERATED');
                
                $table->timestamp('sent_at')->nullable();
                $table->timestamp('delivered_at')->nullable();
                $table->timestamp('read_at')->nullable();

                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};

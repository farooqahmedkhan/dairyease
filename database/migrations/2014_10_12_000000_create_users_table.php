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
        if(!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('name');
    
                $table->string('email')->unique()->nullable();
                $table->timestamp('email_verified_at')->nullable();
    
                $table->string('phone')->unique()->nullable();
                $table->string('phone_verified_at')->nullable();
    
                $table->string('password');
    
                $table->enum('role', ['CUSTOMER', 'PROVIDER', 'CUSTOMER_PROVIDER', 'SUPER_ADMIN', 'ADMIN', 'GUEST'])->default('GUEST');
                
                $table->timestamp('last_login_at');
                $table->string('last_login_ip', 20);
    
                $table->boolean('active')->default(true);
    
                $table->rememberToken();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

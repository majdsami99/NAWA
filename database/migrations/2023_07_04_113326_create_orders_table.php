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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user-id')
            ->nullable()
            ->constrained()
            ->nullOnDelete();
            $table->string('custmer_first_name');
            $table->string('custmer_last_name');
            $table->string('custmer_email');
            $table->string('custmer_phone')->nullable();
            $table->string('custmer_addres');
            $table->string('custmer_city');
            $table->string('custmer_postal_code')->nullable();
            $table->string('custmer_province')->nullable();
            $table->char('custmer_country_code');
            $table->enum('status',['pending','processing','shipped','completed','cancelled','refunded']);
            $table->enum('payment_status',['pending','paid','failed']);
            $table->char('currency')->default('USD');
            $table->float('total')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

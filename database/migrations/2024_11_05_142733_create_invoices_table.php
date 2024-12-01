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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->references('id')->on('customers');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->datetime('date');
            $table->decimal('tax_itbs', 15, 2);
            $table->decimal('subtotal', 15, 2);
            $table->decimal('total', 20, 2);
            $table->string('discount_type')->nullable();
            $table->decimal('discount', 15, 2)->nullable();
            $table->decimal('total_discount', 15, 2)->nullable();
            $table->string('status')->default('Pendiente');
            $table->string('payment_method')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('payment_status')->default('Pendiente');
            $table->date('due_date')->nullable();
            $table->date('paid_date')->nullable();
            $table->string('nif')->nullable();
            $table->string('rfc')->nullable();
            $table->string('currency')->nullable();
            $table->string('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};

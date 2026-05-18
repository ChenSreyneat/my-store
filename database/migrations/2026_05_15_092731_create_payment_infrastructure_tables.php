<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payment_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('payment_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('account_id'); // Bakong ID (e.g. name@bank)
            $table->string('account_name');
            $table->string('account_city')->nullable()->default('Phnom Penh');
            $table->string('currency')->default('USD'); // USD or KHR
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('user_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('payment_method_id')->constrained('payment_accounts')->onDelete('cascade');
            $table->foreignId('payment_status_id')->constrained('payment_statuses')->onDelete('cascade');
            $table->string('transaction_id')->nullable(); // MD5 or Bakong Transaction ID
            $table->decimal('amount', 15, 2);
            $table->string('currency');
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_payments');
        Schema::dropIfExists('payment_accounts');
        Schema::dropIfExists('payment_statuses');
    }
};

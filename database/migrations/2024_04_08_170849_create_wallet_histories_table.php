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
        Schema::create('wallet_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->decimal('amount', 10, 2);  // Số tiền được cộng hoặc trừ
            $table->decimal('balance_after', 10, 2); // Số dư sau khi cộng/trừ
            $table->string('operation'); // 'credit' cho cộng tiền, 'debit' cho trừ tiền
            $table->text('description')->nullable(); // Mô tả cho giao dịch
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallet_histories');
    }
};

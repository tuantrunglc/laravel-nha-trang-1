<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('levels', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('vip_level')->unique();
            $table->decimal('income', 4, 2);
            $table->timestamps();
        });

        // Thêm dữ liệu mẫu cho bảng levels
        DB::table('levels')->insert([
            ['vip_level' => 1, 'income' => 0.5],
            ['vip_level' => 2, 'income' => 0.6],
            ['vip_level' => 3, 'income' => 0.7],
            ['vip_level' => 4, 'income' => 0.8],
            ['vip_level' => 5, 'income' => 0.8],
            ['vip_level' => 6, 'income' => 0.9],
            ['vip_level' => 7, 'income' => 1.0],
            ['vip_level' => 8, 'income' => 1.2],
            ['vip_level' => 9, 'income' => 1.4],
            ['vip_level' => 10, 'income' => 1.6],
            ['vip_level' => 11, 'income' => 2.0],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('levels');
    }
};

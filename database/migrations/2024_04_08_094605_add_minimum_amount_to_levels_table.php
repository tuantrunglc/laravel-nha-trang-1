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
        Schema::table('levels', function (Blueprint $table) {
            $table->decimal('minimum_amount', 10, 2)->after('income'); // Thêm sau cột income
        });

        // Cập nhật bảng levels với số tiền tối thiểu cho mỗi VIP
        DB::table('levels')->where('vip_level', 1)->update(['minimum_amount' => 300]);
        DB::table('levels')->where('vip_level', 2)->update(['minimum_amount' => 1000]);
        DB::table('levels')->where('vip_level', 3)->update(['minimum_amount' => 3000]);
        DB::table('levels')->where('vip_level', 4)->update(['minimum_amount' => 5000]);
        DB::table('levels')->where('vip_level', 5)->update(['minimum_amount' => 10000]);
        DB::table('levels')->where('vip_level', 6)->update(['minimum_amount' => 30000]);
        DB::table('levels')->where('vip_level', 7)->update(['minimum_amount' => 50000]);
        DB::table('levels')->where('vip_level', 8)->update(['minimum_amount' => 100000]);
        DB::table('levels')->where('vip_level', 9)->update(['minimum_amount' => 300000]);
        DB::table('levels')->where('vip_level', 10)->update(['minimum_amount' => 500000]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('levels', function (Blueprint $table) {
            //
        });
    }
};

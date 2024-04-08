<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userLevels = [
            ['level' => 1, 'phone' => '1234567890', 'wallet' => 300],
            ['level' => 2, 'phone' => '1234567891', 'wallet' => 1000],
            ['level' => 3, 'phone' => '1234567892', 'wallet' => 3000],
            ['level' => 4, 'phone' => '1234567893', 'wallet' => 5000],
            ['level' => 5, 'phone' => '1234567894', 'wallet' => 10000],
            ['level' => 6, 'phone' => '1234567895', 'wallet' => 30000],
            ['level' => 7, 'phone' => '1234567896', 'wallet' => 50000],
            ['level' => 8, 'phone' => '1234567897', 'wallet' => 100000],
            ['level' => 9, 'phone' => '1234567898', 'wallet' => 300000],
            ['level' => 10, 'phone' => '1234567899', 'wallet' => 500000],
        ];
        foreach ($userLevels as $userLevel) {
            User::create([
                'name' => 'User '.$userLevel['level'],
                'email' => 'user'.$userLevel['level'].'@example.com',
                'password' => bcrypt('12345678a@'), // Mật khẩu được mã hóa
                'level' => $userLevel['level'],
                'phone' => $userLevel['phone'], // Số điện thoại bắt buộc
                'wallet' => $userLevel['wallet'], // Số tiền ví chính xác cho từng level
            ]);
        }
    }
}

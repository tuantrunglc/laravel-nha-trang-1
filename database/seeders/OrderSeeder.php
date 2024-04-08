<?php

// database/seeders/OrderSeeder.php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();

        foreach ($users as $user) {
            for ($i = 0; $i < 5; $i++) {
                // Chọn một sản phẩm ngẫu nhiên mà giá không vượt quá ví người dùng
                $product = Product::where('price', '<=', $user->wallet)->inRandomOrder()->first();

                // Kiểm tra xem có sản phẩm phù hợp hay không
                if ($product) {
                    Order::create([
                        'user_id' => $user->id,
                        'product_id' => $product->id,
                        'total_price' => $product->price,
                    ]);

                    // Giảm ví người dùng
                    $user->wallet -= $product->price;
                    $user->save();
                }
            }
        }
    }
}

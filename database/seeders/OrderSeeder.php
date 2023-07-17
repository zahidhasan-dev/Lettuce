<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\User;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\OrderItem;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $customers = User::where('is_admin',0)->limit(5)->inRandomOrder()->get();

        foreach ($customers as $customer) {

            $products = Product::where('status',1)->limit(rand(1,3))->inRandomOrder()->get();

            $country = Country::with('city')->inRandomOrder()->first()->toArray();
            $city = $country['city'][array_rand($country['city'])];

            $subtotal = 0;

            if($subtotal > 100){
                $shipping = 0;
            }

            foreach($products as $product){
                $price = productTotalPrice($product->id,1)*100;
                $subtotal += $price;
            }

            $status = ['pending','processing','delivering','completed'];
            $order_status = $status[array_rand($status)];
            $payment_methods = ['card','cod'];
            $payment_method = $payment_methods[array_rand($payment_methods)];
            $payment_status = $payment_method == 'card' || $order_status == 'completed' ? 'paid' : 'due';
            $shipping = config('app.shipping');
            $hasCoupon = rand(0,1);
            $coupon_code = null;
            $coupon_value = null;
            $coupon_amount = 0;

            if ($hasCoupon) {
                $coupon = Coupon::where('status',1)->where('coupon_validity','>=',now())->inRandomOrder()->first();
                
                if(!is_null($coupon)){
                    $coupon_code = $coupon->coupon_code;
                    $coupon_value = $coupon->coupon_value;
                    $coupon_amount = $coupon_value;

                    if($coupon->coupon_type === 'percent'){
                        $coupon_amount = $subtotal * ($coupon->coupon_value / 100);
                    }
                }
            }

            $newSubTotal = $subtotal - $coupon_amount;

            if($newSubTotal < 0){
                $newSubTotal = 0;
            }

            $vat = config('app.vat') / 100;
            $vat_value = $newSubTotal * $vat;
            $order_total = ($newSubTotal * (1 + $vat)) + $shipping;

            $orderId  = Order::insertGetId([
                            'user_id' => $customer->id,
                            'billing_name' => $customer->name,
                            'billing_email' => $customer->email,
                            'billing_phone' => $faker->e164PhoneNumber(),
                            'billing_country' => $country['id'],
                            'billing_city' => $city['id'],
                            'billing_zipcode' => $faker->randomNumber(5),
                            'billing_address' => $faker->address(),
                            'order_note' => $faker->sentence(),
                            'payment_method' => $payment_method,
                            'payment_status' => $payment_status,
                            'coupon' => $hasCoupon,
                            'coupon_code' => $coupon_code,
                            'coupon_value' => $coupon_value,
                            'coupon_amount' => $coupon_amount,
                            'order_subtotal' => $newSubTotal,
                            'order_total' => $order_total,
                            'order_shipping' => $shipping,
                            'order_vat' => $vat * 100,
                            'vat_value' => $vat_value,
                            'order_status' => $order_status,
                            'created_at' => now(),
                        ]); 


            foreach ($products as $product) {
                $product_price =$product->price;

                if(productHasDiscount($product->id)){
                    $product_price = discountPrice($product->id) * 100;
                }

                OrderItem::insert([
                    'order_id' => $orderId,
                    'product_id' => $product->id,
                    'price' => $product_price,
                    'quantity' => 1,
                ]);

                $product->update([
                    'in_stock' => $product->in_stock - 1,
                ]);
                
            }

            
        }

    }
}


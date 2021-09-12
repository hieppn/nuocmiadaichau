<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_methods')->insert([
            'name' => 'Thanh Toán Khi Nhận Hàng (COD)',
            'describe' =>  'Bạn chỉ phải thanh toán khi nhận hàng',
            'created_at'    =>  date('Y-m-d H:i:s', strtotime('now')),
            'updated_at'    =>  date('Y-m-d H:i:s', strtotime('now')),
        ]);
        DB::table('payment_methods')->insert([
            'name' => 'Thanh Toán Momo',
            'describe' =>  '0979396926, vui lòng thanh toán và gọi để xác nhận',
            'created_at'    =>  date('Y-m-d H:i:s', strtotime('now')),
            'updated_at'    =>  date('Y-m-d H:i:s', strtotime('now')),
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TblDetailTransactionTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tbl_detail_transaction')->delete();
        
        \DB::table('tbl_detail_transaction')->insert(array (
            0 => 
            array (
                'id' => 1,
                'transaction_id' => 1,
                'product_id' => 1,
                'serial_no' => '12981289182',
                'serial_no_id' => 1,
                'price' => 10000,
                'discount' => 0,
                'updated_at' => '2023-08-15 14:34:25',
                'created_at' => '2023-08-15 14:34:25',
            ),
            1 => 
            array (
                'id' => 2,
                'transaction_id' => 2,
                'product_id' => 1,
                'serial_no' => '123012093812',
                'serial_no_id' => 2,
                'price' => 10000,
                'discount' => 0,
                'updated_at' => '2023-08-15 14:35:03',
                'created_at' => '2023-08-15 14:35:03',
            ),
            2 => 
            array (
                'id' => 3,
                'transaction_id' => 3,
                'product_id' => 1,
                'serial_no' => '12981289182',
                'serial_no_id' => 1,
                'price' => 10000,
                'discount' => 100,
                'updated_at' => '2023-08-15 14:38:13',
                'created_at' => '2023-08-15 14:38:13',
            ),
            3 => 
            array (
                'id' => 4,
                'transaction_id' => 4,
                'product_id' => 1,
                'serial_no' => '12981289182',
                'serial_no_id' => 1,
                'price' => 10000,
                'discount' => 1000,
                'updated_at' => '2023-08-15 14:39:40',
                'created_at' => '2023-08-15 14:39:40',
            ),
            4 => 
            array (
                'id' => 5,
                'transaction_id' => 5,
                'product_id' => 1,
                'serial_no' => '192912',
                'serial_no_id' => 3,
                'price' => 1000,
                'discount' => 0,
                'updated_at' => '2023-08-15 15:14:29',
                'created_at' => '2023-08-15 15:14:29',
            ),
        ));
        
        
    }
}
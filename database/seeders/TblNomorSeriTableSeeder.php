<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TblNomorSeriTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tbl_nomor_seri')->delete();
        
        \DB::table('tbl_nomor_seri')->insert(array (
            0 => 
            array (
                'id' => 1,
                'product_id' => 1,
                'serial_no' => '12981289182',
                'price' => 10000,
                'prod_date' => '2023-08-23',
                'warranty_start' => '2023-08-18',
                'warranty_duration' => '2023-10-04',
                'used' => 1,
                'updated_at' => '2023-08-15 14:39:40',
                'created_at' => '2023-08-15 14:34:25',
            ),
            1 => 
            array (
                'id' => 2,
                'product_id' => 1,
                'serial_no' => '123012093812',
                'price' => 10000,
                'prod_date' => '2023-08-18',
                'warranty_start' => '2023-09-01',
                'warranty_duration' => '2023-08-19',
                'used' => 0,
                'updated_at' => '2023-08-15 14:35:03',
                'created_at' => '2023-08-15 14:35:03',
            ),
            2 => 
            array (
                'id' => 3,
                'product_id' => 1,
                'serial_no' => '192912',
                'price' => 1000,
                'prod_date' => '2023-08-31',
                'warranty_start' => '2023-08-11',
                'warranty_duration' => '2023-08-04',
                'used' => 0,
                'updated_at' => '2023-08-15 15:14:29',
                'created_at' => '2023-08-15 15:14:29',
            ),
        ));
        
        
    }
}
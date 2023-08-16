<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TblTransactionTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tbl_transaction')->delete();
        
        \DB::table('tbl_transaction')->insert(array (
            0 => 
            array (
                'id' => 1,
                'tanggal' => '2023-08-15',
                'no_trans' => '131505c9-c4c7-4626-bc27-2c64451d40b0',
                'customer' => 'System',
                'tipe_trans' => 'BUY',
                'updated_at' => '2023-08-15 14:34:25',
                'created_at' => '2023-08-15 14:34:25',
            ),
            1 => 
            array (
                'id' => 2,
                'tanggal' => '2023-08-15',
                'no_trans' => '329a7dc3-3cce-4e17-8dc0-f32f738fa0e2',
                'customer' => 'System',
                'tipe_trans' => 'BUY',
                'updated_at' => '2023-08-15 14:35:03',
                'created_at' => '2023-08-15 14:35:03',
            ),
            2 => 
            array (
                'id' => 3,
                'tanggal' => '2023-08-15',
                'no_trans' => 'b914f5a6-0c6d-4c96-ab1c-b1e66aafe1f3',
                'customer' => '100 CUSTOMER',
                'tipe_trans' => 'SELL',
                'updated_at' => '2023-08-15 14:38:13',
                'created_at' => '2023-08-15 14:38:13',
            ),
            3 => 
            array (
                'id' => 4,
                'tanggal' => '2023-08-15',
                'no_trans' => 'ed0f54e5-5e5b-45c6-965b-b572f695fe6f',
                'customer' => '100 CUSOMTER',
                'tipe_trans' => 'SELL',
                'updated_at' => '2023-08-15 14:39:40',
                'created_at' => '2023-08-15 14:39:40',
            ),
            4 => 
            array (
                'id' => 5,
                'tanggal' => '2023-08-15',
                'no_trans' => 'd780347a-cb4b-4cf9-a6f4-f9343ccac99d',
                'customer' => 'System',
                'tipe_trans' => 'BUY',
                'updated_at' => '2023-08-15 15:14:29',
                'created_at' => '2023-08-15 15:14:29',
            ),
        ));
        
        
    }
}
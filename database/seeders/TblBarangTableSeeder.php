<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TblBarangTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tbl_barang')->delete();
        
        \DB::table('tbl_barang')->insert(array (
            0 => 
            array (
                'id' => 1,
                'product_name' => 'kocak',
                'brand' => 'kocaks',
                'price' => 10000,
                'model_no' => '201021',
                'updated_at' => '2023-08-15 14:34:05',
                'created_at' => '2023-08-15 14:34:05',
            ),
        ));
        
        
    }
}
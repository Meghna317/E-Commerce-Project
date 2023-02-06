<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productRecords = [
            [
               'name'=>'Men Polo T-Shirt',
               'sku'=>'B06Y28LCDN',
               'category_id'=>'1',
               'thumbnail'=>'',
               'Description'=>'Buy 3 Get 5% Off, Buy 4 Get 10% Off. Get GST invoice and save up to 28% on business purchases.'
            ],
        ];
        Product::insert($productRecords);
    }
}

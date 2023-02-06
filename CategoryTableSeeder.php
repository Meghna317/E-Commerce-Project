<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryRecords = [
            [
                'name'=>'Men',
                'thumbnail'=>'',
            ],
            [
                'name'=>'Women',
                'thumbnail'=>'',
            ],
        ];
        Category::insert($categoryRecords);
    }
}

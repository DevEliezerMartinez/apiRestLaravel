<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
       DB::table('products')-> insert([
        'name'=> "iphone x",
        'description' => "Mobile phone",
        'price'=> 10000
       ]);

       DB::table('products')->insert([
        'name'=> "iphone 12",
        'description' => "Mobile phone",
        'price'=> 12000

    ]);
       
    }
}

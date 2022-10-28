<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductBrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_brands')->insert([
    		[
    			'product_id' => 1,
    			'brand_id' => 1,
    			
    		],
    		[
    			'product_id' => 1,
    			'brand_id' => 2,
    			
    		],
    		[
    			'product_id' => 1,
    			'brand_id' => 3,
    			
    		],
    		[
    			'product_id' => 2,
    			'brand_id' => 3,
    			
    		],
    		[
    			'product_id' => 3,
    			'brand_id' => 3,
    			
    		],
    		[
    			'product_id' => 2,
    			'brand_id' => 1,
    			
    		],
    		[
    			'product_id' => 4,
    			'brand_id' => 4,
    			
    		],
    		
    	]);
    }
}

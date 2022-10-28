<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
    		[
    			'name' => 'Supper Admin',
    			'display_name' => 'Supper Admin',
    			'description' => 'Supper admin website',
    			'created_at' => now(),
    			'updated_at' => now(),
    		],
    		[
    			'name' => 'User',
    			'display_name' => 'User',
    			'description' => 'User nomal',
    			'created_at' => now(),
    			'updated_at' => now(),
    		],
    	]);
    }
}

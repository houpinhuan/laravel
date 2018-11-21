<?php

use Illuminate\Database\Seeder;

class ProtypeAndProfessionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profession') -> insert([
		    'pro_name'		=>	'php基础班',
		    'protype_id'	=>	'1',
		    'teachers_ids'	=>	'1,2,3,4',
		    'created_at'	=> 	date('Y-m-d H:i:s'),
		    'duration'		=>	18,
		  	'cover_img'		=>	'/statics/1.png',
		    'price'			=>	'100.00'
		]);
		DB::table('profession') -> insert([
		    'pro_name'		=>	'php就业班',
		    'protype_id'	=>	'1',
		    'teachers_ids'	=>	'21,22,23,25',
		    'created_at'	=> 	date('Y-m-d H:i:s'),
		    'duration'		=>	98,
		  	'cover_img'		=>	'/statics/1.png',
		    'price'			=>	'200.00'
		]);
		DB::table('profession') -> insert([
		    'pro_name'		=>	'前端基础班',
		    'protype_id'	=>	'2',
		    'teachers_ids'	=>	'29,30,31,32',
		    'created_at'	=> 	date('Y-m-d H:i:s'),
		    'duration'		=>	90,
		  	'cover_img'		=>	'/statics/1.png',
		    'price'			=>	'100.00'
		]);
		    }
}

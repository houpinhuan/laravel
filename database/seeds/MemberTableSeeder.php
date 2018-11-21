<?php

use Illuminate\Database\Seeder;

class MemberTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //生成faker实例
        $faker = \Faker\Factory::create('zh_CN');
        $data = [];
       	for ($i=0; $i < 500; $i++) { 
       		//访问具体的属性来获取数据
	        $data[] = [
	        	'username'		=>	$faker -> username,
	        	'password'		=>	bcrypt('123456'),
	        	'gender'		=>	rand(1,3),
	        	'mobile'		=>	$faker -> phoneNumber,
	        	'email'			=>	$faker -> email,
	        	'avatar'		=>	'/statics/1.png',
	        	'created_at'	=>	date('Y-m-d H:i:s'),
	        	'type'			=>	rand(1,2),
	        	'status'		=>	rand(1,2)
	        ];
    	}
    	//写入数据表
       	DB::table('member') -> insert($data);
    }
}

<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	$this->call('seedUser');
    }
}
class seedUser extends Seeder
{
	public function run()
	{
		DB::table('user')->insert([
			['email'=>'ngominhthu1611@gmail.com','password'=>bcrypt('1611'),'hoten'=>'Ngô Minh Thư','gioitinh'=>'Nữ','tuoi'=>21,'diachi'=>'Ô môn','thunhap'=>1500000,'level'=>'1'],
        ]);
        DB::table('user')->insert([
			['email'=>'admin','password'=>bcrypt('minhthu1611'),'hoten'=>'Ngô Minh Thư','gioitinh'=>'Nữ','tuoi'=>21,'diachi'=>'Ô môn','thunhap'=>1500000,'level'=>'0','avatar'=>'minhthu.jpg'],
		]);
	}
}

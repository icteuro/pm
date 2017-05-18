<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$this->call('AdminTableSeeder');
	}

}

class AdminTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{	
		DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@ict-euro.com',
            'password' => bcrypt('123456'),
            'user_role' => 1,
            'created_at' => Carbon::now()
        ]);
	}

}

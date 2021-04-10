<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
    	factory(User::class)->create([
    		'id' => 1,
    		'name' => 'akinoringo',
    		'email' => 'test@akinori.com',
    		'password' => Hash::make('akinoringo'),
    	]);
    }
}

<?php

use Illuminate\Database\Seeder;
use App\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'nome'=>'Admin',
            'email'=>'admin@mapos.com',
            'password'=>Hash::make('secret01'),
            'email_verified_at' => $now,
        ]);
    }
}

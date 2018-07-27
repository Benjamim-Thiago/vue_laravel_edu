<?php

use Illuminate\Database\Seeder;

class CreateUserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = factory(BEN\Models\User::class)->create([
            'name' => 'Admin',
            'email' => 'admin@school.com',
            'password' => bcrypt('123456')
        ]);
    }
}

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
        factory(BEN\Models\User::class)->create([
            'email' => 'admin@school.com',
            'enrolment'=>100000
        ]);
    }
}

<?php

use BEN\Models\User;
use Illuminate\Database\Seeder;

class CreateStudentSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class,10)->create()->each(function(User $user){
            if (!$user->userable) 
            {
                User::assignRole($user, User::ROLE_STUDENT);
                User::assignEnrolment(new User(), User::ROLE_STUDENT);
                $user->save();
            }
        });
    }
}

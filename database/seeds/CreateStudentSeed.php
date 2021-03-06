<?php

use BEN\Models\User;
use BEN\Models\UserProfile;
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
        factory(User::class,100)->create()->each(function(User $user){
            if (!$user->userable) 
            {
                User::assignRole($user, User::ROLE_STUDENT);
                User::assignEnrolment(new User(), User::ROLE_STUDENT);
                $profile = factory(UserProfile::class)->make();
                $user->profile()->create($profile->toArray());
                $user->save();
            }
        });
    }
}

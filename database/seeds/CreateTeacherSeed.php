<?php

use BEN\Models\User;
use BEN\Models\UserProfile;
use Illuminate\Database\Seeder;

class CreateTeacherSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*factory(User::class)->create([
            'email' => 'teacher@school.com',
        ])->each(function(User $user){
            User::assignRole($user, User::ROLE_TEACHER);
            User::assignEnrolment(new User(), User::ROLE_TEACHER);
           // User::assignRole($user, User::ROLE_TEACHER);
            $user->save();
        });*/

        factory(User::class,100)->create()->each(function(User $user){
            if (!$user->userable) 
            {
                User::assignRole($user, User::ROLE_TEACHER);
                User::assignEnrolment(new User(), User::ROLE_TEACHER);
                $profile = factory(UserProfile::class)->make();
                $user->profile()->create($profile->toArray());
                $user->save();
            }
        });
    }
}

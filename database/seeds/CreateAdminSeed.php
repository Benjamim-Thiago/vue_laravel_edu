<?php

use BEN\Models\User;
use BEN\Models\UserProfile;
use Illuminate\Database\Seeder;

class CreateAdminSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        factory(User::class)->create([
            'email' => 'admin@school.com',
            'enrolment'=>100001
        ])->each(function(User $user){
            User::assignRole($user, User::ROLE_ADMIN);
           // User::assignRole($user, User::ROLE_TEACHER);
            $profile = factory(UserProfile::class)->make();
            $user->profile()->create($profile->toArray());
            $user->save();
        });

    }
}

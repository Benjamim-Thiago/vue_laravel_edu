<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        // $this->call(UsersTableSeeder::class);        
        $this->call(CreateAdminSeed::class);
        $this->call(CreateTeacherSeed::class);
        $this->call(CreateStudentSeed::class);
        $this->call(CreateSubjectSeed::class);
        $this->call(CreateClassInformationsSeed::class);
    }

}

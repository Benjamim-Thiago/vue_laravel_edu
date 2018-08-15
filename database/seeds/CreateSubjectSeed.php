<?php

use Illuminate\Database\Seeder;

class CreateSubjectSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\BEN\Models\Subject::class,50)->create();
    }
}

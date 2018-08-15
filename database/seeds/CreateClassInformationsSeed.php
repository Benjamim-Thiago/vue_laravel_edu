<?php

use Illuminate\Database\Seeder;

class CreateClassInformationsSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\BEN\Models\ClassInformation::class,50)->create();
    }
}

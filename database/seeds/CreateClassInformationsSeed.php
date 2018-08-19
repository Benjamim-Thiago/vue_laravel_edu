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
        $students = \BEN\Models\Student::all();
        factory(\BEN\Models\ClassInformation::class,50)
        ->create()
        ->each(function (\BEN\Models\ClassInformation $model) use ($students){
            /** @var Illuminate\Support\Collection $studentsCol */
            $studentsCol = $students->random(10);
            $model->students()->attach($studentsCol->pluck('id'));
        });
    }
}

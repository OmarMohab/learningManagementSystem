<?php

namespace Database\Seeders;

use App\Models\Grade;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateGradesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $grades = [
            ['name'=>'First Grade'],
            ['name'=>'Second Grade'],
            ['name'=>'Third Grade'],
            ['name'=>'Fourth Grade'],
            ['name'=>'Fifth Grade'],
            ['name'=>'Sixth Grade'],
        ];

        foreach ($grades as $key => $grade) {
            Grade::create($grade);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Grade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('Grades')->delete();
        $names = [
            ["en" => "primary grade", "ar" => "المرحلة الابتدائية"],
            ["en" => "middle grade", "ar" => "المرحلة الاعدادية"],
            ["en" => "secondary grade", "ar" => "المرحلة الثانوية"],
        ];
        $notes = [
            "primary grade has 6 classes",
            "middle grade has 3 classes",
            "secondary grade has 3 classes",
        ];
        $i = 0;
        foreach ($names as $name) {
            Grade::create([
                "Name" => $name,
                "Notes" => $notes[$i],
            ]);
            $i++;
        }
    }
}

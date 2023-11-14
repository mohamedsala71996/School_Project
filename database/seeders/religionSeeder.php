<?php

namespace Database\Seeders;

use App\Models\religion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class religionSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    DB::table('religions')->delete();
    $religion = [
      ["en" => "Muslim", "ar" => "مسلم"],
      ["en" => "christian", "ar" => "مسيحي"],
      ["en" => "other", "ar" => "آخر"],
    ];
    foreach ($religion as  $religion) {
      religion::create([
        "Name" => $religion,
      ]);
    }
  }
}

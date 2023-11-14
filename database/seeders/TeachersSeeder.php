<?php
namespace Database\Seeders;
use App\Models\Specialization;
use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeachersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teachers')->delete();
        $teachers = new Teacher();
        $teachers->email ="ahmed_sala712@yahoo.com" ;
        $teachers->password = bcrypt('123456789');
        $teachers->Name = ['ar' => 'احمد صلاح', 'en' => 'Ahmed salah'];
        $teachers->Specialization_id = Specialization::all()->unique()->random()->id;
        $teachers->Gender_id =1;
        $teachers->Joining_Date = date('Y-m-d H:i:s');
        $teachers->Address = "mansoura";
        $teachers->save();
    }
}
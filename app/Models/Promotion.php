<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $table = 'promotions';


    public $guarded = [];

    public function Student()
    {
        return $this->belongsTo(Student::class, "student_id");
    }

    public function Grade_from()
    {
        return $this->belongsTo(Grade::class, "from_grade");
    }
    public function Classroom_from()
    {
        return $this->belongsTo(Classroom::class, "from_Classroom");
    }
    public function Section_from()
    {
        return $this->belongsTo(Section::class, "from_section");
    }
    public function Grade_to()
    {
        return $this->belongsTo(Grade::class, "to_grade");
    }
    public function Classroom_to()
    {
        return $this->belongsTo(Classroom::class, "to_Classroom");
    }
    public function Section_to()
    {
        return $this->belongsTo(Section::class, "to_section");
    }
}

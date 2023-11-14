<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    public $guarded = [];

    public function student()
    {
        return $this->belongsTo(Student::class, "student_id");
    }
    public function grade()
    {
        return $this->belongsTo(Grade::class, "Grade_id");
    }
    public function section()
    {
        return $this->belongsTo(Section::class, "section_id");
    }
}

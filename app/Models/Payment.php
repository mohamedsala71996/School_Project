<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';

    public $guarded = [];

    public function student()
    {
        return $this->belongsTo(Student::class, "student_id");
    }
}

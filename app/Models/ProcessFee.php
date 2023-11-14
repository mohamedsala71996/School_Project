<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcessFee extends Model
{
    use HasFactory;
    protected $table = 'process_fees';


    public $guarded = [];


    public function student()
    {
        return $this->belongsTo('App\Models\Student', 'student_id');
    }
}

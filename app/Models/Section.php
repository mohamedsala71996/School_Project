<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Models\Grade;


class Section extends Model
{
    use HasTranslations;

    public $translatable = ['Name'];
    protected $table = 'sections';
    public $timestamps = true;
    protected $fillable = [
        'Name',
        'status',
        'Grade_id',
        'Class_id',
    ];

    public function Grade()
    {
        return $this->belongsTo(Grade::class, 'Grade_id');
    }

    public function class_room()
    {
        return $this->belongsTo(Classroom::class, 'Class_id');
    }
    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, "teacher_section");
    }
}

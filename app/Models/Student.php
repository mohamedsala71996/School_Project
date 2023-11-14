<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Student extends Authenticatable
{
    use HasFactory;
    use HasTranslations;
    use SoftDeletes;
    public $translatable = ['Name'];
    protected $guarded = [];
    protected $table = 'students';



    public function gender()
    {
        return $this->belongsTo(Gender::class, "gender_id");
    }
    public function Grade()
    {
        return $this->belongsTo(Grade::class, "Grade_id");
    }
    public function Classroom()
    {
        return $this->belongsTo(Classroom::class, "Classroom_id");
    }
    public function section()
    {
        return $this->belongsTo(section::class, "section_id");
    }
    public function Nationalities()
    {
        return $this->belongsTo(Nationalities::class, "nationalitie_id");
    }
    public function My_Parent()
    {
        return $this->belongsTo(My_Parent::class, "parent_id");
    }

    public function Images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function Attendance(): HasMany
    {
        return $this->hasMany(Attendance::class, 'student_id');
    }
}

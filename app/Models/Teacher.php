<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Teacher extends Authenticatable
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['Name'];
    protected $guarded = [];
    protected $table = 'teachers';

    public function Specialization()
    {
        return $this->belongsTo(Specialization::class, "Specialization_id");
    }

    public function Gender()
    {
        return $this->belongsTo(Gender::class, "Gender_id");
    }

    public function sections()
    {
        return $this->belongsToMany(Section::class, "teacher_section");
    }
}

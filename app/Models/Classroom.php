<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;
use App\Models\Grade;



class Classroom extends Model
{
    use HasTranslations;
    public $translatable = ['Name'];
    protected $table = 'classrooms';
    protected $fillable = [
        'Name',
        'Grade_id',
    ];
    public $timestamps = true;


    public function Grade(): BelongsTo
    {
        return $this->belongsTo(Grade::class, 'Grade_id');
    }

    public function Section()
    {
        return $this->hasMany(Section::class, 'Class_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Relations\HasMany;




class Grade extends Model
{
    use HasTranslations;

    public $translatable = ['Name'];
    protected $table = 'Grades';
    protected $fillable = [
        'Name',
        'Notes',
    ];
    public $timestamps = true;

    public function section(): HasMany
    {
        return $this->hasMany(Section::class, 'Grade_id');
    }
}

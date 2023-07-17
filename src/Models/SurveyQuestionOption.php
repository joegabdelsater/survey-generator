<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyQuestionOption extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function question()
    {
        return $this->belongsTo(SurveyQuestion::class);
    }

    public function answers()
    {
        return $this->hasMany(SurveyUserAnswer::class);
    }
}

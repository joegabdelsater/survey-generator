<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyQuestion extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }

    public function type()
    {
        return $this->belongsTo(SurveyQuestionType::class, 'survey_question_type_id');
    }

    public function options()
    {
        return $this->hasMany(SurveyQuestionOption::class);
    }

    public function answers()
    {
        return $this->hasMany(SurveyUserAnswer::class);
    }
}

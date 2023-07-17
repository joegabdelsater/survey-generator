<?php

namespace Joegabdelsater\SurveyGenerator;

use App\Models\Survey;
use App\Models\SurveyQuestion;
use App\Models\SurveyQuestionType;

class SurveyGenerator
{
    /**
     * Fill a survey, the function accesses the request() helper function directly.
     * survey_id int The survey id
     * question_{$question->id}  the id of the qestion appended to the question_ string, the value is the answer
     */
    public static function submit()
    {
        $survey = Survey::findOrFail(request('survey_id'));
        $userId = auth()->user()->id;

        $survey->questions->each(function ($question) use ($userId) {
            $answer = request('question_' . $question->id) ?? null;

            if ($question->type->name == 'text') {
                $question->answers()->create([
                    'survey_question_id' => $question->id, 
                    'user_id' => $userId,
                    'answer' => $answer,
                ]);
            } else {
                $question->answers()->create([
                    'survey_question_id' => $question->id, 
                    'user_id' => $userId,
                    'survey_question_option_id' => $answer,
                ]);
            }
        });
    }

    /**
     * Get the survey results.
     * @param int|bool $surveyId if false, return the first survey
     */
    public static function getAnsweredSurvey($surveyId = false, $userId = false)
    {
        if(!$userId){
            $userId = auth()->user()->id;
        }
        if(!$surveyId){
            $surveyId = Survey::first()->id;
        }
        $query = Survey::with('questions.answers.option')
            ->whereHas('questions.answers', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            });

        if ($surveyId) {
            return $query->find($surveyId);
        }

        return $query->first();
    }

    /**
     * Get the survey form.
     * @param int|bool $surveyId if false, return the first survey
     */
    public static function getSurveyForm($surveyId = false)
    {
        $query = Survey::with('questions.options', 'questions.type');

        if ($surveyId) {
            return $query->findOrFail($surveyId);
        }

        return $query->first();
    }


    public static function generateForm() {
        $survey = Survey::create([
            'name' => 'Survey 1',
        ]);

        $type = SurveyQuestionType::create([
            'name' => 'text',
        ]);

        $type2 = SurveyQuestionType::create([
            'name' => 'radio',
        ]);

        $question1 = SurveyQuestion::create([
            'survey_id' => $survey->id,
            'survey_question_type_id' => $type->id,
            'question' => 'What is your name?',
        ]);

        $question2 = SurveyQuestion::create([
            'survey_id' => $survey->id,
            'survey_question_type_id' => $type2->id,
            'question' => 'What is your age?',
        ]);

        $question1->options()->create([
            'option' => 'Joe',
        ]);

        $question1->options()->create([
            'option' => 'John',
        ]);

        $question1->options()->create([
            'option' => 'Jack',
        ]);

        $question2->options()->create([
            'option' => '18',
        ]);

        $question2->options()->create([
            'option' => '19',
        ]);

        $question2->options()->create([
            'option' => '20',
        ]);
    }

    public static function generateAnswers() {
        $survey = Survey::first();
        $userId = 1;

        $survey->questions->each(function ($question) use ($userId) {
            if ($question->type->name == 'text') {
                $question->answers()->create([
                    'survey_question_id' => $question->id,
                    'user_id' => $userId,
                    'answer' => "text answer",
                ]);
            } else {
                $question->answers()->create([
                    'survey_question_id' => $question->id,
                    'user_id' => $userId,
                    'survey_question_option_id' => $question->options->first()->id,
                ]);
            }
        });
    }
}

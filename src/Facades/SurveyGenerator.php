<?php
namespace Joegabdelsater\SurveyGenerator\Facades;

use Illuminate\Support\Facades\Facade;

class SurveyGenerator extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'survey-generator';
    }
}
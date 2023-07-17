# Step 1
`composer require joegabdelsater/survey-generator`

# Step 2
`php artisan vendor:publish` and select the appropriate package number

# Step 3
`php artisan migrate`

# Functions

To use the package add to your class `use Joegabdelsater\SurveyGenerator`

## For dummy data creation

`SurveyGenerator::generateForm()`
`SurveyGenerator::generateAnswers()`

Make sure you have a user with id 1 as it is hardcoded in the function

## For use
- `SurveyGenerator::getSurveyForm($surveyId = false)` if $surveyId is not passed, the first survey is retrieved

- `SurveyGenerator::getAnsweredSurvey($surveyId = false, $userId = false)` if $surveyId is not passed, the first survey is retrieved, $userId is used in the testing functions

- `SurveyGenerator::submit()` 
it accesses the $request object directly, make sure to pass the survey_id, and the answers should have a key of `question_{$questionId}`.

if the question type is text, the value should be what is gathered from the user input. if not, the option_id should be provided
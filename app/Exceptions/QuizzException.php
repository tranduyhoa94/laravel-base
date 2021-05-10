<?php

namespace App\Exceptions;

use Ky\Core\Exceptions\BaseException;

class QuizzException extends BaseException
{
    public static function notAllowSubmitQuizz()
    {
        return self::code(__('quiz.can_not_submit'));
    }

    public static function notFromHandler()
    {
        return self::code(__('quiz.not_from_handler'));
    }

    public static function errorQuestionApproved()
    {
        return self::code(__('quession.approved'));
    }

    public static function notAllowApprovedQuizz()
    {
        return self::code(__('quiz.can_not_approved'));
    }

    public static function notAllowApprovedQuizzHaveApproved()
    {
        return self::code(__('quiz.can_not_approved_have_approved'));
    }

    public static function notDeniedQuizzWasApproved()
    {
        return self::code(__('quiz.can_not_denied_was_approved'));
    }

    public static function notDeniedQuizz()
    {
        return self::code(__('quiz.can_not_denied'));
    }

    public static function notDeleteQuestion()
    {
        return self::code(__('quession.not_delete_question'));
    }

    public static function notDeleteQuestionFromHandler()
    {
        return self::code(__('quession.not_delete_question_hanlder'));
    }

    public static function notAllowUpdateQuizz()
    {
        return self::code(__('quiz.can_not_update'));
    }

    public static function notAllowDeleteQuizz()
    {
        return self::code(__('quiz.can_not_delete'));
    }

    public static function numberQuestionsNotCorrect()
    {
        return self::code(__('quiz.number_questions_not_correct'));
    }
}

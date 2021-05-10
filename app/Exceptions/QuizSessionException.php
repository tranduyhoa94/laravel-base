<?php

namespace App\Exceptions;

use Ky\Core\Exceptions\BaseException;

class QuizSessionException extends BaseException
{
    public static function notAllowCompletedQuizz()
    {
        return self::code(__('quiz_session.can_not_update'));
    }

    public static function errorExitTeacher()
    {
        return self::code(__('errors.check_exit_teacher'));
    }

    public static function quizSessionHasBeenSubmited()
    {
        return self::code(__('quiz_session.has_been_submited'));
    }

    public static function quizSessionHasBeenCompleted()
    {
        return self::code(__('quiz_session.has_been_submited'));
    }
}

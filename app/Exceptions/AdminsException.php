<?php

namespace App\Exceptions;

use Ky\Core\Exceptions\BaseException;

class AdminsException extends BaseException
{
    public static function notUpdateAdmin()
    {
        return self::code(__('errors.admin_not_update'));
    }

    public static function notDeleteAdmin()
    {
        return self::code(__('errors.admin_not_delete'));
    }

    public static function errorCheckExitScheduleRoom()
    {
        return self::code(__('errors.check_exit_schedule_room'));
    }

    public static function errorCheckExitScheduleTeacher()
    {
        return self::code(__('errors.check_exit_schedule_teacher'));
    }

    public static function errorExitTeacher()
    {
        return self::code(__('errors.check_exit_teacher'));
    }

    public static function errorSystem()
    {
        return self::code(__('errors.error_system'));
    }

    public static function errorAppointmentDenied()
    {
        return self::code(__('errors.appointment_denied'));
    }

    public static function errorAppointmentApproved()
    {
        return self::code(__('errors.appointment_approved'));
    }

    public static function errorCheckExitScheduleRoomOrTeacher()
    {
        return self::code(__('errors.check_exit_schedule_room_or_teacher'));
    }
}

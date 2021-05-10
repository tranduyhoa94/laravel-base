<?php

return [
    'errors' => [
        'route_not_found' => 'Route not found !',
        'record_not_found' => 'Record not found !',
        'unhandled_exception' => 'An unknown error happen !',
        'validation_error' => 'There was an error in the input !',
        'session_not_found' => 'Session not found !',
        'throttle_request' => 'Too many attempts. Please try again later !',
        'admin_not_update' => 'Can\'t update super administrators!',
        'admin_not_delete' => 'Can\'t delete super administrators!',
        'check_exit_schedule_room' => 'Room already exist',
        'check_exit_schedule_teacher' => 'Teacher already exist',
        'check_exit_schedule_room_or_teacher' => 'Conflicting schedule',
        'check_exit_teacher' => 'Teacher already assign',
        'error_system' => 'Error system',
        'appointment_denied' => 'Appointment not denied when appointment have approved',
        'appointment_approved' => 'Appointment not approved when appointment have denied'
    ],
    'login' => [
        'invalid_credentials' => 'Email or password not correct',
    ],
    'quiz' => [
        'can_not_submit' => 'Quiz cant submit ! Quiz only pending or preapprove to allow submit',
        'can_not_approved' => 'Quiz cant approved ! Quiz only submit to allow approved',
        'not_from_handler' => 'Quiz is not from handler',
        'can_not_approved_have_approved' => 'Can not update Quiz was approved',
        'can_not_denied_was_approved' => 'Can not denied Quiz as approved',
        'can_not_denied' => 'Quiz cant denied ! Quiz only submit to allow denied',
        'can_not_update' => 'Quiz cant update ! Quiz only pending or preapprove to allow update',
        'can_not_delete' => 'Quiz can\'t delete ! Quiz only pending or preapprove to allow delete',
        'number_questions_not_correct' => 'Questions not enough !'
    ],
    'quession' => [
        'approved' => 'Can not update question was approved',
        'not_delete_question' => 'Can not delete question was approved',
        'not_delete_question_hanlder' => 'Question is not from handler',
    ],
    'quiz_session' => [
        'can_not_update' => 'Can not update quiz session not was Submited',
        'has_been_submited' => 'The quiz session has been submited',
        'success_submit_mcq' => 'Submit success ! Check out the results in the Quiz Review section',
        'success_submit_blank' => 'Submit success ! Waiting teacher checking',
        'examine_quiz_success' => 'Examine Quiz success'
    ],
    'notification' => [
        'appointment_tile' => 'Appointment',
        'appointment_approved' => 'Your appointment has been confirmed, a tutor will be sent on the date provided.',
        'schedule_title' => 'Schedule',
        'schedule_created' => 'A new schedule has been created, please check the app / website for the changes.',
        'schedule_updated' => 'Your schedule has been updated, please check the app / website for the changes.'
    ]
];

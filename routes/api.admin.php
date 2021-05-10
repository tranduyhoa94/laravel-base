<?php

use Illuminate\Support\Facades\Route;

Route::pattern('id', '[0-9]+');

Route::post('login', 'AuthenticateController@login')->name('auth.login');

Route::prefix('password')->name('password.')->group(function () {
    $passwordCtrl = "\\" . \App\Http\Controllers\PasswordController::class;

    Route::post('forgot', "$passwordCtrl@sendResetLinkEmail")->name('sendResetLinkEmail');
    // Route::post('reset', "$passwordCtrl@reset")->name('reset');
});

Route::middleware(['auth:admin'])->group(function () {
    $meCrl = "\\" . \App\Http\Controllers\MeController::class;

    Route::get('me', "$meCrl@me")->name('me');
    Route::put('update-password', "$meCrl@updatePassword")->name('update-password');
    Route::put('update-profile', "$meCrl@updateProfileAdmin")->name('update-profile');

    # Teachers
    Route::apiResource('teachers', 'TeacherController');
    # Subject
    Route::apiResource('subjects', 'SubjectController');
    # admins
    Route::apiResource('admins', 'AdminController');
    # Topics
    Route::apiResource('topics', 'TopicController');
    # Students
    Route::apiResource('students', 'StudentController');
    # Rooms
    Route::apiResource('rooms', 'RoomController');
    # Schedules
    Route::apiResource('schedules', 'ScheduleController');
    # Appointment
    Route::apiResource('appointments', 'AppointmentController')->only('index');

    Route::post('link-appointment/{id_appointment}', 'AppointmentController@createAccoutnStudent');

    Route::post('appointments/{id}/approved', 'AppointmentController@updateApprovedAppointment');

    Route::post('appointments/{id}/denied', 'AppointmentController@updateDeniedAppointment');

    Route::post('teachers/{id}/active', 'TeacherController@active');

    Route::post('students/{id}/active', 'StudentController@active');

    Route::post('admins/{id}/active', 'AdminController@active');

    Route::post('topics/{id}/active', 'TopicController@active');

    Route::post('subjects/{id}/active', 'SubjectController@active');

    Route::post('schedules/{id}/active', 'ScheduleController@active');

    # About us
    Route::get('about-us', 'AboutUsController@index');
    Route::put('about-us', 'AboutUsController@update');
    
    # Quizz
    Route::apiResource('quizzes', 'QuizzController')->only('store', 'index', 'show', 'update', 'destroy');
    Route::put('quizzes/{id}/submit', 'QuizzController@submit')->name('quizzes.submit');
    Route::put('quizzes/{id}/approved', 'QuizzController@updateApprovedQuizz')->name('quizzes.update');
    Route::put('quizzes/{id}/denied', 'QuizzController@updateDeniedQuizz')->name('quizzes.denied');

    # Question
    Route::apiResource('questions', 'QuestionController')->only('store', 'update', 'destroy');

    # Quiz Question
    Route::apiResource('quiz-sessions', 'QuizSessionController')->only('index', 'show');
    Route::put('quiz-sessions/{id}/assign', 'QuizSessionController@assignTeacher');

    # Image
    Route::apiResource('images', 'ImageController')->only('store');

    # Limit Test
    Route::apiResource('limit-tests', 'LimitTestController')->only('store', 'index', 'destroy');

    # Subject token
    Route::put('student-subjects-taken/{id}', 'SubjectTakenController@update')->name('update.student');
});

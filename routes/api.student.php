<?php

use Illuminate\Support\Facades\Route;

Route::pattern('id', '[0-9]+');

Route::post('login', 'StudentAuthenticateController@login')->name('auth.login');

Route::apiResource('subjects', 'SubjectController')->only('index');

Route::apiResource('schedules', 'SchedulesController')->only('index');

Route::apiResource('topics', 'TopicController')->only('index');

Route::post('register', 'AuthStudentController@registerStudent');

# About us
Route::get('about-us', 'AboutUsController@index');

Route::prefix('password')->name('password.')->group(function () {
    $passwordCtrl = "\\" . \App\Http\Controllers\PasswordController::class;

    Route::post('forgot', "$passwordCtrl@sendResetLinkEmail")->name('sendResetLinkEmail');
    // Route::post('reset', "$passwordCtrl@reset")->name('reset');
});

Route::middleware(['auth:student'])->group(function () {
    $meCrl = "\\" . \App\Http\Controllers\MeController::class;

    Route::get('me', "$meCrl@me")->name('me');
    Route::put('update-profile', "$meCrl@updateProfile")->name('update-profile');
    Route::put('update-password', "$meCrl@updatePassword")->name('update-password');
    Route::post('logout', "$meCrl@logout")->name('logout');

    # Appointment
    Route::apiResource('appointments', 'AppointmentController')->only('index', 'store');
    # Personal Calendar
    Route::get('calendar', 'CalendarController@index')->name('calendar');
    # Quizz
    Route::get('quizzes', 'QuizzController@index');
    Route::get('quiz-test', 'QuizzController@quizTest');

    # Quiz sessions
    Route::get('quiz-sessions/{id}', 'QuizSessionController@show');
    Route::put('quiz-sessions/{id}/submit', 'QuizSessionController@submit');
    Route::apiResource('quiz-sessions', 'QuizSessionController')->only('index');
    Route::get('quiz-sessions/{id}/show', 'QuizSessionController@showQuizSession');

    # Subject Taken
    Route::apiResource('subjects-taken', 'SubjectTakenController')->only('index');

    # Device Token
    Route::post('register-devices', "DeviceTokenController@registerDevices")->name('registerDevices');
});

<?php

use Illuminate\Support\Facades\Route;

Route::pattern('id', '[0-9]+');

Route::post('login', 'TeacherAuthenticateController@login')->name('auth.login');

Route::prefix('password')->name('password.')->group(function () {
    $passwordCtrl = "\\" . \App\Http\Controllers\PasswordController::class;

    Route::post('forgot', "$passwordCtrl@sendResetLinkEmail")->name('sendResetLinkEmail');
    // Route::post('reset', "$passwordCtrl@reset")->name('reset');
});

Route::middleware(['auth:teacher'])->group(function () {
    $meCrl = "\\" . \App\Http\Controllers\MeController::class;

    Route::get('me', "$meCrl@me")->name('me');
    Route::put('update-profile', "$meCrl@updateProfile")->name('update-profile');
    Route::put('update-password', "$meCrl@updatePassword")->name('update-password');

    # Appointment
    Route::apiResource('appointments', 'AppointmentController')->only('index');
    # Personal calendar
    Route::get('calendar', 'CalendarController@index')->name('calendar');
    # Question
    Route::apiResource('questions', 'QuestionController')->only('store', 'update', 'destroy');
    # Quizz
    Route::apiResource('quizzes', 'QuizzController')->only('index', 'store', 'show', 'update');
    Route::put('quizzes/{id}/submit', 'QuizzController@submit')->name('quizzes.submit');
    # Quiz Question
    Route::apiResource('quiz-sessions', 'QuizSessionController')->only('index', 'show');
    # Quiz Session
    Route::put('quiz-sessions/{id}/examine', 'QuizSessionController@examineQuizSession');
    # Image
    Route::apiResource('images', 'ImageController')->only('store');
});

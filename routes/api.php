<?php

use Illuminate\Support\Facades\Route;

Route::get('swagger/{site}.json', 'SwaggerController@index')->where('site', '(admin)');

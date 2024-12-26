<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->group(function () {
    Route::post('/iniciaSesion', 'Api\V1\UserController@login');
});

Route::middleware('auth:sanctum')->prefix('v1')->group(function () {  //Se aplico middleware para dar seguridad al API rest, usando el sanctum
    Route::get('/students', 'Api\V1\StudentController@show');
    Route::get('/students/{id}', 'Api\V1\StudentController@buscar_estudiante');
    Route::put('/students/{id}','Api\V1\StudentController@update');   
    Route::post('/students', 'Api\V1\StudentController@store');
    Route::post('/logout', 'Api\V1\UserController@logout');
 });
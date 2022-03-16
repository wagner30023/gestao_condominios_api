<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BilletController;
use App\Http\Controllers\DocController;
use App\Http\Controllers\FoundAndLostController;
use App\Http\Controllers\ReservetionController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WallController;
use App\Http\Controllers\WarningController;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/ping', function () {
    return ['pong' => true];
});

Route::get('/401',[AuthController::class,'unauthorized'])->name('login');
Route::post('/auth/login',[AuthController::class,'login']);
Route::post('/auth/register',[AuthController::class,'register']);

Route::middleware('auth:api')->group(function(){
    Route::post('/auth/validate',[AuthController::class,'validateToken']);
    Route::post('/auth/logout',[AuthController::class,'logout']);

    // Mural de Avisos
    Route::get('/walls',[WallController::class,'getAll']);
    Route::get('/wall/{id}/like',[WallController::class,'like']);

    // Documentos
    Route::get('/docs',[DocController::class,'getAll']);

    // Livro de ocorrências
    Route::get('/warnings',[WarningController::class,'getMyWarnings']);
    Route::post('/warning',[WarningController::class,'setWarning']);
    Route::post('/warning/file',[WarningController::class,'addWarningFile']);

    // Boletos
    Route::get('/billets',[BilletController::class,'getAll']);

    // Achados e perdidos
    Route::get('/foundandlost',[FoundAndLostController::class,'getAll']);
    Route::post('/foundandlost',[FoundAndLostController::class,'insert']);
    Route::get('/foundandlost/{id}',[FoundAndLostController::class,'update']);

    // Unidade
    Route::get('/unit/{id}',[UnitController::class,'getInfo']);
    Route::post('/unit/{id}/addperson',[UnitController::class,'addPerson']);
    Route::post('/unit/{id}/addvehicle',[UnitController::class,'addvehicle']);
    Route::post('/unit/{id}/addpet',[UnitController::class,'addpet']);
    Route::get('/unit/{id}/removeperson',[UnitController::class,'removePerson']);
    Route::get('/unit/{id}/removevehicle',[UnitController::class,'removevehicle']);
    Route::get('/unit/{id}/removepet',[UnitController::class,'removepet']);

    // Reservas
    Route::get('/reservations',[ReservetionController::class,'getReservations']);
    Route::post('/reservation/{id}',[ReservetionController::class,'setReservation']);

    Route::get('/reservation/{id}/disableddates',[ReservetionController::class,'getDisableDates']);
    Route::get('/reservation/{id}/times',[ReservetionController::class,'getTimes']);

    Route::get('/myreservations',[ReservationController::class,'getMyReservations']);
    Route::delete('/myreservation/{id}',[ReservetionController::class,'delMyReservations']);
});

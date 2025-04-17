<?php

use App\Http\Controllers\EquipmentTypeController;
use App\Http\Controllers\EquipmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('equipment-types', EquipmentTypeController::class);
Route::apiResource('equipment', EquipmentController::class);

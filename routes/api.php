<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\StudentController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/students',[StudentController::class,'index']);
Route::post('/students',[StudentController::class,'postStudent']);
Route::get('/student/{id}',[StudentController::class,'getStudent']);
Route::get('/student/{id}/update',[StudentController::class,'getStudent']);
Route::put('/student/{id}/update',[StudentController::class,'updateStudent']);
Route::delete('/student/{id}/delete',[StudentController::class,'deleteStudent']);

Route::post('/student_details/{id}',[StudentController::class,'createStudentDetails']);
Route::get('/student_details/{id}',[StudentController::class,'getStudentProfile']);
Route::delete('/student_details/{id}/delete',[StudentController::class,'deleteStudentProfile']);
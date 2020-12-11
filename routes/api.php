<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
// use App\Http\Controllers\Printer;

Route::post('login',[UserController::class, 'login']);
Route::post('createjobs',[JobsController::class, 'createJobs']);
Route::post('delJob',[JobsController::class, 'delJob']);
Route::post('updateJob/{id}',[JobsController::class, 'updateJob']);
Route::get('getjobs',[JobsController::class, 'getJobs']);
Route::get('getjobs/{id}',[JobsController::class, 'getJobsById']);
Route::get('getcounters',[JobsController::class, 'getcounters']);
Route::get('getJobsByEmployeeId/{id}',[JobsController::class, 'getJobsByEmployeeId']);
Route::post('updateStatusByJobId',[JobsController::class, 'updateStatusByJobId']);
Route::post('uploadImageByJobId',[JobsController::class, 'uploadImageByJobId']);
Route::post('jobCompletionByJobId',[JobsController::class, 'jobCompletionByJobId']);

// User Area
Route::post('registerEmployee',[UserController::class, 'registerUser']);
Route::post('registerSubAdmin',[UserController::class, 'registerUser']);
Route::get('getEmployees',[UserController::class, 'getEmployees']);
Route::get('getSubadmins',[UserController::class, 'getSubadmins']);
Route::get('getUserById/{id}',[UserController::class, 'getUserById']);
Route::post('EditUser',[UserController::class, 'EditUser']);
Route::get('delUserById/{id}',[UserController::class, 'delUserById']);

Route::get('test', function() {
    $user = array();
    $user = [
        'password' => \Str::random(10),
        'email' => 'inziprince87@gmail.com',
        'f_name' => 'Inzamam',
        'l_name' => 'Idrees'
    ];
    
    \Mail::send('email.register', ['random' => '<p>Your password is </p><h4>'.$user['password'].'</h4>'], function($message)  use ($user)
    {
        // dd($user['email']);
        $message->to($user['email'], $user['f_name'].' '.$user['l_name'])->subject('Welcome to Contractor!');
    });
	return true;
});

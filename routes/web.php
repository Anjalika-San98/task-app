<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Taskcontroller;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::resource('/tasks', Taskcontroller::class)->middleware('auth');

Route::get('/markascompleted/{id}', [Taskcontroller::class,'UpdateTaskAsCompleted'])->middleware('auth');

Route::get('/markasnotcompleted/{id}', [Taskcontroller::class,'UpdateTaskAsNotCompleted'])->middleware('auth');

Route::get('/deleteTask/{id}', [Taskcontroller::class,'DeleteTask'])->middleware('auth');

Route::get('/updatetask/{id}', [Taskcontroller::class,'UpdateTaskView'])->middleware('auth');

Route::get('/updatetasks', [Taskcontroller::class,'updatetask'])->middleware('auth');

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

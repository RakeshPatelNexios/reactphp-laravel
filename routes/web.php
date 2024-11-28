<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ItemController;

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

Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
Route::get('/tasks/logs', [TaskController::class, 'logs'])->name('logs');

Route::get('/students', [StudentController::class, 'index'])->name('list');
Route::get('/students-listings', [StudentController::class, 'getStudentsListings'])->name('students.list');
Route::get('/students/create', [StudentController::class, 'create'])->name('student.create');
Route::post('/student/store', [StudentController::class, 'store'])->name('student.store');

Route::get('/itemslist', [ItemController::class, 'itemslist'])->name('items.list'); // Get all items listings screen
Route::get('/itemscreate', [ItemController::class, 'itemscreate'])->name('items.create'); // Get all items listings screen
Route::get('/items', [ItemController::class, 'index']); // Get all items
Route::post('/items', [ItemController::class, 'store']); // Add new item

Route::group(['middleware' => ['auth']], function () {
    
});

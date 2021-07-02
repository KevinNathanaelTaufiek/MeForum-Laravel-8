<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\CommentController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/forums', [ForumController::class, 'index']);
Route::get('/forum/{id}', [ForumController::class, 'getForum']);
Route::get('/create', [ForumController::class, 'create']);

Route::post('/create', [ForumController::class, 'store']);
Route::patch('/update/{id}', [ForumController::class, 'update']);
Route::delete('/delete/{id}', [ForumController::class, 'delete']);

Route::post('/reply', [CommentController::class, 'store']);
Route::patch('/reply/update/{id}', [CommentController::class, 'update']);

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('allUsers');
})->name('allusers')->middleware('admin.privilege');

Route::get('allusers',[AdminController::class,'index'])->name("showUsers")->middleware('admin.privilege');

Route::get('delete_user/{id}',[AdminController::class,'destroy'])->name("delete")->middleware('admin.privilege');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

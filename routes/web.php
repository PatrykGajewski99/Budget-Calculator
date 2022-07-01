<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegisterController;
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

Route::get('/welcome', function () {
    return view('welcome');
});

//Admin routes
Route::get('/adminDashBoard', function () {
    return view('adminDashBoard');
})->name('adminDash')->middleware('admin.privilege');

Route::get('/', function () {
    return view('allUsers');
})->name('/allusers')->middleware('admin.privilege');


Route::get('/allusers',[AdminController::class,'index'])->name("showUsers")->middleware('admin.privilege');

Route::get('delete_user/{id}',[AdminController::class,'destroy'])->name("delete")->middleware('admin.privilege');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//User routes
Route::get('/addExpense',function (){
  return(view('addExpense'));
})->name('expenseDash')->middleware('user.privilege');

Route::post('/expense',[UserController::class,'addExpense'])->name("addExpense")->middleware('user.privilege');

Route::get('/userDashBoard', function () {
    return view('userDashBoard');
})->name('userDash')->middleware('user.privilege');


Route::get('/calculate',[UserController::class,'sumPrice'])->name('calculate')->middleware('user.privilege');

Route::get('/getExpenses/{table_name}',[UserController::class,'getExpenses'])->name('getExpenses')->middleware('user.privilege');

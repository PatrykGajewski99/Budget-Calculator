<?php

namespace App\Http\Controllers;
use App\Models\User;
use Auth;
use DB;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function addExpense(Request $request)
    {
        $tableName=$request->post('expense');
        DB::table($tableName)->insert([
           'user_id'=>Auth::user()->id,
            'place'=>$request->post('place'),
            'price'=>$request->post('price'),
            'details'=>$request->post('details')
        ]);
    }
}

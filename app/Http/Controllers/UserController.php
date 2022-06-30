<?php

namespace App\Http\Controllers;
use App\Models\User;
use Auth;
use DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
class UserController extends Controller
{
    public function addExpense(Request $request)
    {
        $tableName=$request->post('expense');
        DB::table($tableName)->insert([
           'user_id'=>Auth::user()->id,
            'place'=>$request->post('place'),
            'price'=>$request->post('price'),
            'details'=>$request->post('details'),
            'date'=>Carbon::now()->format('Y-m-d'),
        ]);
        return redirect('addExpense');
    }
}

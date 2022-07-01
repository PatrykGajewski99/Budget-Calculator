<?php

namespace App\Http\Controllers;
use App\Models\User;
use Auth;
use DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

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
        Alert::success('Great Job','Your expense added.');
        return redirect('addExpense');
    }
    public function getFoodExpenses()
    {
        $id=Auth::user()->id;
        $data=DB::SELECT('SELECT * FROM foods WHERE user_id=?',[$id]);
        return view('food-expenses',['data'=>$data]);
    }
    public function sumPrice()
    {
        $id=Auth::user()->id;
        $sum=DB::SELECT('SELECT sum(price) as price FROM foods WHERE user_id=?',[$id]);
        foreach ($sum as $row)
        {
            $finalPrice=$row->price;
        }
        var_dump($finalPrice);
        if((float)$finalPrice<100.00)
        Alert::success('Great Job','Your expenses: '.$finalPrice);
        else
            Alert::warning('WOW','Your expense are to hight: '.$finalPrice);
        return redirect('getFoodExpenses');
    }
}

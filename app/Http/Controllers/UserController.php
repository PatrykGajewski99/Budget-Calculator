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
            'created_at'=>Carbon::now()->format('Y-m-d'),
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
    public function sumPrice(Request $request)
    {
        $id=Auth::user()->id;
        $dataFrom=$request->input('dayFrom');;
        $timestamp=strtotime($dataFrom);
        $convertDataFrom=date('Y-m-d',$timestamp);
        $dataTo=$request->input('dayTo');
        $timestamp2=strtotime($dataTo);
        $convertDataTo=date('Y-m-d',$timestamp2);
        if($convertDataFrom>$convertDataTo) {
            Alert::error('Fatal Error','Start date must be smaller then end date. ');
        }
        else{
            $tableName=$request->input('calculate');
            $sum = DB::table($tableName)
                ->select(DB::raw("SUM(price) as price"))
                ->where('user_id', '=',$id)
                ->where('created_at','>=',$convertDataFrom)
                ->where('created_at','<=',$convertDataTo)
                ->get();
            foreach ($sum as $row)
            {
                $finalPrice=$row->price;
            }
            if((float)$finalPrice<1000.00)
                Alert::success('Great Job','Your expenses: '.$finalPrice.' zł');
            else
                Alert::warning('WOW','Your expense are to high: '.$finalPrice.'  zł');
        }

        return redirect('getFoodExpenses');
    }
}

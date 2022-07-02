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
    public function getExpenses($table_name)
    {
        $id=Auth::user()->id;
        $data=DB::table($table_name)
            ->select(DB::raw('place,created_at,details,price'))
            ->where('user_id','=',$id)
            ->get();
        return view($table_name.'Expenses',['data'=>$data]);
    }
    public function getFillterExpenses($table_name,$dataFrom,$dataTo)
    {
        $id=Auth::user()->id;
        $data=DB::table($table_name)
            ->select(DB::raw('place,created_at,details,price'))
            ->where('user_id','=',$id)
            ->where('created_at','>=',$dataFrom)
            ->where('created_at','<=',$dataTo)
            ->get();
        return $data;
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
        $tableName=$request->input('calculate');
        if($convertDataFrom>$convertDataTo) {
            Alert::error('Fatal Error','Start date must be smaller then end date. ');
        }
        else{
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
            if($finalPrice=="")
            {
                $finalPrice=0;
            }
            if((float)$finalPrice<1000.00)
                Alert::success('Great Job','Your expenses: '.$finalPrice.' zł');
            else
                Alert::warning('WOW','Your expense are to high: '.$finalPrice.'  zł');
        }
        $data=$this->getFillterExpenses($tableName,$convertDataFrom,$convertDataTo);
        return view($tableName.'Expenses',['data'=>$data]);
    }
    public function calculateExpenses()
    {
        $id=Auth::user()->id;
        $food = DB::table('foods')
            ->select(DB::raw("SUM(price) as price"))
            ->where('user_id', '=',$id)
            ->get();
        foreach ($food as $row)
        {
            $finalFoodPrice=$row->price;
        }
        $bills = DB::table('bills')
            ->select(DB::raw("SUM(price) as price"))
            ->where('user_id', '=',$id)
            ->get();
        foreach ($bills as $row)
        {
            $finalBillsPrice=$row->price;
        }
        $parties = DB::table('party')
            ->select(DB::raw("SUM(price) as price"))
            ->where('user_id', '=',$id)
            ->get();
        foreach ($parties as $row)
        {
            $finalPartiesPrice=$row->price;
        }
        if($finalPartiesPrice=="")
            $finalPartiesPrice=0;
        if($finalFoodPrice=="")
            $finalFoodPrice=0;
        if($finalBillsPrice=="")
            $finalBillsPrice=0;
        return view('userDashBoard',compact('finalFoodPrice','finalBillsPrice','finalPartiesPrice'));
    }
}

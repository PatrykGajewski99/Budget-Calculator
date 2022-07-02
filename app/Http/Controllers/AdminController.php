<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check())
        {
            $users=DB::select('Select * from users');
            return view('allUsers',['users'=>$users]);
        }
    }

    public function destroy($id)
    {
       DB::delete('delete from users where id =? ',[$id]);
        return redirect()->route('showUsers');
    }
    public function calculateExpenses()
    {
        $food = DB::table('foods')
            ->select(DB::raw("SUM(price) as price"))
            ->get();
        foreach ($food as $row)
        {
            $finalFoodPrice=$row->price;
        }
        $bills = DB::table('bills')
            ->select(DB::raw("SUM(price) as price"))
            ->get();
        foreach ($bills as $row)
        {
            $finalBillsPrice=$row->price;
        }
        $parties = DB::table('party')
            ->select(DB::raw("SUM(price) as price"))
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
        return view('adminDashBoard',compact('finalFoodPrice','finalBillsPrice','finalPartiesPrice'));
    }
}

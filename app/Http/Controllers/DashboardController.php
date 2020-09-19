<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Expense;
use DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

   
    public function index()
    {
        $user_expenses = DB::table('expenses AS e')
            ->join('expense_categories AS ec', 'ec.id', '=', 'e.category_id')
            ->select('ec.name AS category_name', DB::raw('SUM(e.amount) AS total_amount'))
            ->where('e.user_id', '=', auth()->user()->id)
            ->groupBy('category_name')
            ->orderBy('category_name', 'ASC')
            ->get();

        $array_name = array();
        $array_amount = array();
        foreach($user_expenses as $user_expense) {
            $array_name[] = $user_expense->category_name;
            $array_amount[] = $user_expense->total_amount;
        }
        $category_name =  json_encode($array_name);
        $total_amount =  json_encode($array_amount);
        
        return view('pages.dashboard.dashboard', compact('category_name', 'total_amount', 'user_expenses'));
    }
}

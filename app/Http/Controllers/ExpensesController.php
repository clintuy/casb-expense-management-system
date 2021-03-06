<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Expense;
use App\ExpenseCategory;
use Carbon\Carbon;
use DB;

class ExpensesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        abort_unless(\Gate::allows('expense_access'), 403);

        //get all expense
        $expenses = DB::table('expenses AS e')
            ->join('expense_categories AS ec', 'e.category_id', '=', 'ec.id')
            ->select('ec.name AS category_name', 'e.*')
            ->where('user_id', '=' ,auth()->user()->id)
            ->get();
        return view('pages.expenses.index', compact('expenses'));

       
    }


    public function create()
    {
        abort_unless(\Gate::allows('add_expense'), 403);

        $expense_categories = ExpenseCategory::orderBy('name', 'ASC')->get();

        return view('pages.expenses.create', compact('expense_categories'));
    }


    public function store(Request $request)
    {
        abort_unless(\Gate::allows('add_expense'), 403);

        // validate inputs
        $validator = $request->validate([
            'expenseName' => ['required'],
            'expenseCategory' => ['required'],
            'amount' => ['required', 'regex:/^\d*(\.\d{1,2})?$/'],
            'expenseDate' => ['required']
        ]);

        $expense = Expense::create([
            'name' => $request['expenseName'],
            'amount' => $request['amount'],
            'expense_date' => Carbon::parse($request['expenseDate'])->format('Y-m-d'),
            'category_id' => $request['expenseCategory'],
            'description' => $request['description'],
            'user_id' => auth()->user()->id
        ]);
        
        
        return redirect()->route('expenses.index')
            ->with('success', 'Expense successfully created!');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        abort_unless(\Gate::allows('edit_expense'), 403);

        $expense = Expense::where('id', $id)->firstOrFail();

        $expense_categories = ExpenseCategory::all();

        return view('pages.expenses.edit', compact('expense', 'expense_categories'));
    }


    public function update(Request $request, $id)
    {
        abort_unless(\Gate::allows('edit_expense'), 403);

        // validate inputs
        $validator = $request->validate([
            'expenseName' => ['required'],
            'expenseCategory' => ['required'],
            'amount' => ['required', 'regex:/^\d*(\.\d{1,2})?$/'],
            'expenseDate' => ['required']
        ]);

        $expense = Expense::where('id', $id)
            ->update([
                'name' => $request['expenseName'],
                'amount' => $request['amount'],
                'expense_date' => Carbon::parse($request['expenseDate'])->format('Y-m-d'),
                'category_id' => $request['expenseCategory'],
                'description' => $request['description']
        ]);
        
        
        return redirect()->route('expenses.index')
            ->with('success', 'Expense successfully updated!');
    }


    public function destroy($id)
    {
        abort_unless(\Gate::allows('delete_expense'), 403);

        $expense = Expense::where('id', $id)->firstOrFail();
        $expense->delete();

        return redirect()->route('expenses.index')
            ->with('success', 'Expense data successfully deleted!');
    }
}

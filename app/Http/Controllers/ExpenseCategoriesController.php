<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\ExpenseCategory;

class ExpenseCategoriesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        abort_unless(\Gate::allows('expense_category_access'), 403);

        //get all expense category
        $expense_categories = ExpenseCategory::all();

        return view('pages.expense_categories.index', compact('expense_categories'));
    }


    public function create()
    {
        abort_unless(\Gate::allows('add_expense_category'), 403);

        return view('pages.expense_categories.create');
    }


    public function store(Request $request)
    {
        abort_unless(\Gate::allows('add_expense_category'), 403); 

        // validate inputs
        $validator = $request->validate([
            'categoryName' => ['required', 'string', 'max:255', 'unique:expense_categories,name']
        ]);

        // add new expense category
        $expense_category = ExpenseCategory::create([

            'name' => $request['categoryName'],
        ]);

        return redirect()->route('expense-categories.index')
            ->with('success', 'Expense Category successfully created!');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        abort_unless(\Gate::allows('edit_expense_category'), 403);

        // find expense expense category
        $expense_category = ExpenseCategory::where('id', $id)->firstOrFail();

        return view('pages.expense_categories.edit', compact('expense_category'));
    }


    public function update(Request $request, $id)
    {
        abort_unless(\Gate::allows('edit_expense_category'), 403);

        // validate inputs
        $validator = $request->validate([
            'categoryName' => ['required', 'string', 'max:255', 'unique:expense_categories,name,' . $id]
        ]);

        // get permission using this id and update
        $expense_category = ExpenseCategory::where('id', $id)
            ->update([
            'name' => $request['categoryName']
        ]);

        return redirect()->route('expense-categories.index')
            ->with('success', 'Permission successfully updated!');
    }


    public function destroy($id)
    {
        abort_unless(\Gate::allows('delete_expense_category'), 403);

        $expense_category = ExpenseCategory::where('id', $id)->firstOrFail();
        $expense_category->delete();

        return redirect()->route('expense-categories.index')
            ->with('success', 'Expense Category data successfully deleted!');
    }
}

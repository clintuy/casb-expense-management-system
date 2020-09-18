<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\ExpenseCategory;

class ExpenseCategoriesController extends Controller
{

    public function index()
    {
        //get all expense category
        $expense_categories = ExpenseCategory::all();

        return view('pages.expense_categories.index', compact('expense_categories'));
    }


    public function create()
    {
        return view('pages.expense_categories.create');
    }


    public function store(Request $request)
    {
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
        // find expense expense category
        $expense_category = ExpenseCategory::where('id', $id)->firstOrFail();

        return view('pages.expense_categories.edit', compact('expense_category'));
    }


    public function update(Request $request, $id)
    {
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
        $expense_category = ExpenseCategory::where('id', $id)->firstOrFail();
        $expense_category->delete();

        return redirect()->route('expense-categories.index')
            ->with('success', 'Expense Category data successfully deleted!');
    }
}

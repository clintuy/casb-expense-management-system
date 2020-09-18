<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Expense;

class ExpenseCategory extends Model
{
    public $table = "expense_categories";
    protected $guarded = [];
}

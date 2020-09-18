<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ExpenseCategory;

class Expense extends Model
{
    public $table = "expenses";
    protected $guarded = [];
}

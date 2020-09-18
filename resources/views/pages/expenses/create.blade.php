@extends('layouts.app')
@section('main-content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Expense Management</li>
        <li class="breadcrumb-item"><a class="text-dark" href="/expenses">Expense</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create Expense</li>
    </ol>
</nav>

<div id="expense-page">
    <div class="card">
        <div class="card-header">
            <h3><b>Create Expense</b></h3>
        </div>
        <div class="card-body">
        
            <p>Note: Filled marked with an ( <span style="color:red">*</span> ) are required</p>

            <form method="POST" action="{{ route('expenses.store') }}">
            @csrf

                <div class="row">

                    <!-- Category Lists -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="expenseCategory"><b>Expense Category <span style="color:red">*</span></b></label>
                            <select id="expenseCategory" name="expenseCategory" class="form-control @error('expenseCategory') is-invalid @enderror">
                                @foreach($expense_categories as $expense_category)
                                    <option value="{{ $expense_category->id }}">{{ $expense_category->name }}</option>
                                @endforeach
                            </select>
                            @error('expenseCategory')
                                <span class="invalid-feedback pb-3" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <!-- Expense Name -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="expenseName"><b>Expense Name <span style="color:red">*</b></span></label>
                            <input 
                                id="expenseName" 
                                name="expenseName" 
                                class="form-control @error('expenseName') is-invalid @enderror" 
                                type="text"   
                                value="{{ old('expenseName') }}"
                                placeholder="Enter your Expense name"
                                autocomplete="expenseName"
                            />
                            @error('expenseName')
                                <span class="invalid-feedback pb-3" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="amount"><b>Amount <span style="color:red">*</b></span></label>
                            <input 
                                id="amount" 
                                name="amount" 
                                class="form-control @error('amount') is-invalid @enderror" 
                                type="text"   
                                value="{{ old('amount') }}"
                                placeholder="Enter your Expense name"
                                autocomplete="amount"
                                onkeypress="return isNumberKey(event)"
                            />
                            @error('amount')
                                <span class="invalid-feedback pb-3" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="expenseDate"><b>Expense Date <span style="color:red">*</b></span></label>
                            <div class="input-group date" id="expenseDate" data-target-input="nearest">
                                <input 
                                    name="expenseDate" 
                                    type="text" 
                                    class="form-control datetimepicker-input @error('expenseDate') is-invalid @enderror" 
                                    value="{{ old('expenseDate') }}"
                                    data-target="#expenseDate"
                                    placeholder="Y-m-d"
                                />
                                <div class="input-group-append" data-target="#expenseDate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>

                            @error('expenseDate')
                                <span style="color:#e3342f; padding:5px;font-size: 80%;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description"><b>Description</b></span></label>
                            <textarea id="description" name="description" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Save Expense Button -->
                <div class="text-right mt-3">
                    <button class="btn btn-dark" type="submit"><i class="fas fa-plus"></i> Save Expense</a>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function isNumberKey(evt){
        var charCode = (evt.which) ? evt.which : event.keyCode;
        return !(charCode > 31 && (charCode < 45 || charCode > 57));
    }


    $('#expenseDate').datetimepicker({
        format: 'L'
    });
</script>
@endsection
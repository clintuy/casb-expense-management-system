@extends('layouts.app')
@section('main-content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">User Management</li>
        <li class="breadcrumb-item"><a class="text-dark" href="/expense-categories">Expense Category</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Expense Category</li>
    </ol>
</nav>

<div id="expense-category-page">
    <div class="card">
        <div class="card-header">
            <h3><b>Edit Expense Category</b></h3>
        </div>
        <div class="card-body">
        
            <p>Note: Filled marked with an ( <span style="color:red">*</span> ) are required</p>

            <form method="POST" action="{{ route('expense-categories.update', $expense_category->id) }}">
            @method('PATCH')
            @csrf

                <div class="row">
                    <!-- Expense Category Name Field -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="categoryName"><b>Expense Category Name <span style="color:red">*</b></span></label>
                            <input 
                                id="categoryName" 
                                name="categoryName" 
                                class="form-control @error('categoryName') is-invalid @enderror" 
                                type="text"   
                                value="{{ old('categoryName') ?? $expense_category->name }}"
                                placeholder="Enter your Expense_Category Name"
                                autocomplete="categoryName"
                            />
                            @error('name')
                                <span class="invalid-feedback pb-3" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Edit Expense Category Button -->
                <div class="text-right mt-3">
                    <button class="btn btn-dark" type="submit"><i class="fas fa-download"></i> Update Expense Category</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
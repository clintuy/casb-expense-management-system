@extends('layouts.app')
@section('main-content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Expense Management</li>
        <li class="breadcrumb-item"><a class="text-dark" href="/expense-categories">Expense Category</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create Expense Category</li>
    </ol>
</nav>

<div id="expense-category-page">
    <div class="card">
        <div class="card-header">
            <h3><b>Create Expense Category</b></h3>
        </div>
        <div class="card-body">
        
            <p>Note: Filled marked with an ( <span style="color:red">*</span> ) are required</p>

            <form method="POST" action="{{ route('expense-categories.store') }}">
            @csrf

                <div class="row">
                    <!-- Category Name Field -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="categoryName"><b>Expense Category Name <span style="color:red">*</b></span></label>
                            <input 
                                id="categoryName" 
                                name="categoryName" 
                                class="form-control @error('categoryName') is-invalid @enderror" 
                                type="text"   
                                value="{{ old('categoryName') }}"
                                placeholder="Enter your Expense Category name"
                                autocomplete="categoryName"
                            />
                            @error('categoryName')
                                <span class="invalid-feedback pb-3" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Save Expense Category Button -->
                <div class="text-right mt-3">
                    <button class="btn btn-dark" type="submit"><i class="fas fa-download"></i> Save Expense Category</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')
@section('main-content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Expense Management</li>
        <li class="breadcrumb-item active" aria-current="page">Expense Category</li>
    </ol>
</nav>

<div id="expense-category-page">

    <!-- Add Permission Button -->
    <div class="text-right mb-2">
        <a class="btn btn-dark" href="{{ route('expense-categories.create') }}"><i class="fas fa-plus"></i> Add Expense Category</a>
    </div>

    <div class="card">
        <div class="card-header">
            <h3><b>Expense Category Details</b></h3>
        </div>
        <div class="card-body">

            <!-- Validation if adding of user is successful -->
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

            <div class="table-responsive">
                <table id="tableExpenseCategory" class="table table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Expense Category ID</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        <!-- Permission Lists -->
                        @foreach ($expense_categories as $expense_category)
                            <tr>
                                <td>{{ $expense_category->id }}</td>
                                <td>{{ $expense_category->name }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Action Group">

                                        <!-- Edit Expense Category Button -->
                                        @can('edit_expense_category')
                                            <a href="{{ route('expense-categories.edit', $expense_category->id) }}" class="btn btn-sm btn-outline-dark"><i class="fas fa-user-edit"></i></a>
                                        @endcan

                                        <!-- Delete Expense Category Button -->
                                        @can('delete_expense_category')
                                            <form method="POST" action="{{ route('expense-categories.destroy', $expense_category->id) }}">
                                            {{ method_field('DELETE') }}
                                            @csrf
                                                <button class="btn btn-sm btn-outline-dark" type="submit" value="Delete" onclick="return confirm('Are you sure you want to delete this expense category data?')"><i class="fas fa-trash-alt"></i></button> 
                                            </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $('#tableExpenseCategory').DataTable();
</script>
@endsection
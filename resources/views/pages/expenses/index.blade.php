@extends('layouts.app')
@section('main-content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Expense Management</li>
        <li class="breadcrumb-item active" aria-current="page">Expense</li>
    </ol>
</nav>

<div id="expense-page">

    <!-- Add Permission Button -->
    <div class="text-right mb-2">
        <a class="btn btn-dark" href="{{ route('expenses.create') }}"><i class="fas fa-plus"></i> Add Expense</a>
    </div>

    <div class="card">
        <div class="card-header">
            <h3><b>Expense Details</b></h3>
        </div>
        <div class="card-body">

            <!-- Validation if adding of user is successful -->
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

            <div class="table-responsive">
                <table id="tableExpense" class="table table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Expense Category ID</th>
                            <th>Category Name</th>
                            <th>Expense Name</th>
                            <th>Amount</th>
                            <th>Description</th>
                            <th>Expense Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        <!-- Permission Lists -->
                        @foreach ($expenses as $expense)
                            <tr>
                                <td>{{ $expense->id }}</td>
                                <td>{{ $expense->category_name }}</td>
                                <td>{{ $expense->name }}</td>
                                <td>{{ $expense->amount }}</td>
                                <td>{{ $expense->description }}</td>
                                <td>{{ $expense->expense_date }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Action Group">

                                        <!-- Edit Expense Button -->
                                        @can('edit_expense')
                                            <a href="{{ route('expenses.edit', $expense->id) }}" class="btn btn-sm btn-outline-dark"><i class="fas fa-edit"></i></a>
                                        @endcan

                                        <!-- Delete Expense Button -->
                                        @can('delete_expense')
                                            <form method="POST" action="{{ route('expenses.destroy', $expense->id) }}">
                                            {{ method_field('DELETE') }}
                                            @csrf
                                                <button class="btn btn-sm btn-outline-dark" type="submit" value="Delete" onclick="return confirm('Are you sure you want to delete this expense data?')"><i class="fas fa-trash-alt"></i></button> 
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
    $('#tableExpense').DataTable();
</script>
@endsection
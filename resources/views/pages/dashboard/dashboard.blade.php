@extends('layouts.app')

@section('main-content')
<div id="dashboard-page">
    <div class="container-fluid">
        <div class="row">
            <!-- Pie Chart -->
            <div class="col-md-5">
                <canvas id="pieExpenseChart" width="auto" height="auto"></canvas>
                <hr>
                <div class="card mt-5">
                    <div class="card-header">
                        Category Names and Total Expenses
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tableExpenses" class="table table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Category Name</th>
                                        <th>Total Amout</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($user_expenses as $user_expense)
                                        <tr>
                                            <td>{{ $user_expense->category_name }}</td>
                                            <td>{{ $user_expense->total_amount }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Bar Graph -->
            <div class="col-md-7">
                <canvas id="barExpenseChart" width="auto" height="auto"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
    $('#tableExpenses').DataTable({
        "pageLength": 3,
        "lengthMenu": [[3, 5, -1], [3, 5, "All"]]
    });
var barChart = document.getElementById('barExpenseChart').getContext('2d');
var barExpenseChart = new Chart(barChart, {
    type: 'bar',
    data: {
        labels: {!! $category_name !!},
        datasets: [{
            label: 'Total Expense Per Category',
            data: {!! $total_amount !!},
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});

var pieChart = document.getElementById('pieExpenseChart').getContext('2d');
var pieExpenseChart = new Chart(pieChart, {
    type: 'pie',
    data: {
        labels: {!! $category_name !!},
        datasets: [{
            label: 'Total Expense Per Category',
            data: {!! $total_amount !!},
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>
@endsection

<div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-custom-secondary text-white" id="sidebar-wrapper">
        <div class="sidebar-heading">Expense Management</div>
        <div class="list-group list-group-flush">
            <ul class="side-bar-buttons">

                <li class="nav-item">
                    <a href="/dashboard" class="list-group-item list-group-item-action"><i class="fas fa-chart-line pr-3"></i>Dashboard</a>
                </li>

                @can('user_management_access')
                <li class="nav-item">
                    <a class="list-group-item list-group-item-action collapsed" id="arrow-icon" href="#sub-menu" data-toggle="collapse" data-target="#sub-menu"><i class="fas fa-users-cog pr-3"></i>User Management<i class="fas fa-angle-right fa-lg" style="float: right"></i></a>

                    <div class="collapse" id="sub-menu" aria-expanded="false" style="padding:0; margin:0">
                        <ul class="flex-column nav">

                            @can('user_access')
                            <li class="nav-item">
                                <a class="list-group-item list-group-item-action" href="/users">
                                    <i class="fas fa-users px-3"></i>Users
                                </a>
                            </li>
                            @endcan

                            @can('role_access')
                            <li class="nav-item">
                                <a class="list-group-item list-group-item-action" href="/roles">
                                    <i class="fas fa-user-tag px-3"></i>Roles
                                </a>
                            </li>
                            @endcan

                            @can('permission_access')
                            <li class="nav-item">
                                <a class="list-group-item list-group-item-action" href="/permissions">
                                    <i class="fas fa-user-lock px-3"></i>Permission
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </div>
                </li>
                @endcan

                @can('expense_management_access')
                <li class="nav-item">
                    <a class="list-group-item list-group-item-action collapsed" id="arrow-icon" href="#product-menu" data-toggle="collapse" data-target="#product-menu"><i class="fas fa-hand-holding-usd pr-3"></i>Expense Management<i class="fas fa-angle-right fa-lg" style="float: right"></i></a>
                    <div class="collapse" id="product-menu" aria-expanded="false" style="padding:0; margin:0">
                        <ul class="flex-column nav">
                            @can('expense_category_access')
                            <li class="nav-item">
                                <a class="list-group-item list-group-item-action" href="/expense-categories">
                                <i class="fas fa-money-check px-3"></i>Expense Category
                                </a>
                            </li>
                            @endcan

                            @can('expense_access')
                            <li class="nav-item">
                                <a class="list-group-item list-group-item-action" href="/expenses">
                                <i class="fas fa-balance-scale-right px-3"></i>Expenses
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </div>
                </li>
                @endcan
            </ul>
        </div>
    </div>
    <!-- Sidebar -->

    <!-- Page Content -->
    <div id="page-content-wrapper">
        <nav class="navbar navbar-expand-lg navbar-dark bg-custom-primary">
            <button class="btn btn-dark" id="menu-toggle">
                <i class="fas fa-arrow-left fa-lg pt-1"></i>
            </button>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ auth()->user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right rounded-0" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" id="btnLogout" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="containter-fluid p-3">
            @yield('main-content')
        </div>
    </div>
</div>


<script>
    const userArrow = document.querySelector('#user-arrow-icon');

    $(document).on("click", "#arrow-icon", function(){
        $(this).find("i").toggleClass("fas fa-angle-right fas fa-angle-down");
    });
    // Toggle the sidebar
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
      $(this).find("i").toggleClass("fas fa-arrow-left fas fa-arrow-right");
    });

    // Add active class to the current button (highlight it)
    $(document).ready(function() {
    $.each($('.side-bar-buttons').find('li'), function() {
            $(this).toggleClass('active',
                window.location.pathname.indexOf($(this).find('a').attr('href')) > -1);
        });
    });
</script>
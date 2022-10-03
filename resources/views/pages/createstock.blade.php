@extends('layouts.app')
@section('content')
    <div class="container-scroller">
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo me-5" href="/"><span class="me-2"> <b>STATIONARY</b>
                    </span></a>
                <a class="navbar-brand brand-logo-mini" href="/"><span> <strong>S.M.S</strong> </span></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="ti-view-list"></span>
                </button>
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item nav-profile dropdown">
                        <div class="p-3 text-dark">{{ Auth::user()->name }}</div>
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
                            <img src="images/faces/face28.jpg" alt="profile" />
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">

                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             document.getElementById('logout-form').submit();">
                                <i class="ti-power-off text-primary"></i>
                                {{ __('Logout') }}
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>
                            </a>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                    <span class="ti-view-list"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/">
                            <i class="ti-panel menu-icon text-dark"></i>
                            <span class="menu-title text-dark">Dashboard</span>
                        </a>
                    </li>
                    @if (Auth::user()->role_id == 1)
                        <li class="nav-item">
                            <a class="nav-link" href="/users">
                                <i class="ti-user menu-icon text-dark"></i>
                                <span class="menu-title text-dark">Users</span>
                            </a>
                        </li>
                    @endif

                    <li class="nav-item">
                        <a class="nav-link" href="/products">
                            <i class="ti-view-list menu-icon text-dark"></i>
                            <span class="menu-title text-dark">Products</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false"
                            aria-controls="ui-basic">
                            <i class="ti-archive menu-icon text-dark "></i>
                            <span class="menu-title text-dark">Stocks</span>
                            <i class="menu-arrow text-dark"></i>
                        </a>
                        <div class="collapse" id="ui-basic">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item "> <a class="nav-link text-dark" href="/createstock">Create
                                        Stocks</a></li>
                                <li class="nav-item "> <a class="nav-link text-dark" href="/managestock">Manage
                                        Stocks</a></li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/report">
                            <i class="ti-write menu-icon text-dark"></i>
                            <span class="menu-title text-dark">Report</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">

                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Create Stock</h4>
                                @if (session('success'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <form class="forms-sample" action="{{ route('create_stock') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Stock Name</label>
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                                        @error('name')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group ">
                                        <label for="stock_in_date">Stock In Date</label>
                                        <input type="date" class="form-control" name="stock_in_date" id="stock_in_date">
                                        @error('stock_in_date')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="end_of_stock">End of Stock</label>
                                        <input type="date" class="form-control" name="end_of_stock" id="end_of_stock">
                                        @error('end_of_stock')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="total_cost_of_stock">Total Cost of the Stock</label>
                                        <input type="number" class="form-control" name="total_cost_of_stock"
                                            id="total_cost_of_stock" placeholder="Total cost of the stock">
                                        @error('total_cost_of_stock')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-12 grid-margin stretch-card">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title">Products</h4>

                                                <div class="table-responsive">
                                                    <table class="table table-striped">
                                                        @if (count($products) > 0)
                                                            @foreach ($products as $product)
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="py-1">
                                                                            <div class="form-check">
                                                                                <label class="form-check-label"
                                                                                    for="product_item_{{ $product->id }}">
                                                                                    <input type="checkbox"
                                                                                        class="form-check-input"
                                                                                        value="{{ $product->id }}"
                                                                                        name="products[]"
                                                                                        id="product_item_{{ $product->id }}">

                                                                                    <i class="input-helper"></i></label>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            {{ $product->name }}
                                                                        </td>
                                                                        <td>
                                                                            <input type="text"
                                                                                class="form-control form-control-sm"
                                                                                placeholder="Quantity" min="1"
                                                                                placeholder="Quantity" name="quantity[]"
                                                                                id="quantity{{ $product->id }}" disabled>
                                                                        </td>
                                                                        <td>
                                                                            <input type="text"
                                                                                class="form-control form-control-sm"
                                                                                placeholder="Buying price"
                                                                                name="buying_price[]"
                                                                                id="buying_price{{ $product->id }}"
                                                                                disabled>
                                                                        </td>
                                                                        <td>
                                                                            <input type="text"
                                                                                class="form-control form-control-sm"
                                                                                placeholder="selling price"
                                                                                name="selling_price[]"
                                                                                id="selling_price{{ $product->id }}"
                                                                                disabled>
                                                                        </td>
                                                                        <td>
                                                                            <input type="date"
                                                                                class="form-control form-control-sm"
                                                                                placeholder="date" name="expire_date[]"
                                                                                id="expire_date{{ $product->id }}"
                                                                                disabled>
                                                                        </td>
                                                                    </tr>
                                                            @endforeach
                                                        @endif


                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" id="create_stock_button" class="btn btn-primary me-2"
                                        disabled>Create
                                        Stock</button>

                                </form>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
@endsection

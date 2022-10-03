@extends('layouts.app')
@section('content')
    <div class="container-scroller">
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo me-5" href="/"><span class="me-2"> <b>STATIONARY</b>
                    </span></a>
                <a class="navbar-brand brand-logo-mini" href="/"><span> <b>S.M.S</b> </span></a>
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
                    <div class="row">
                        <div class="col-md-12 grid-margin">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h4 class="font-weight-bold mb-0">Stationary Dashboard</h4>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @if (Auth::user()->role_id == 1)
                            <div class="col-md-6 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body btn-primary">
                                        <p class="card-title text-md-center text-xl-left text-dark">Users</p>
                                        <div
                                            class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                                            <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">{{ count($users) }}
                                            </h3>
                                            <i class="ti-user icon-md text-dark mb-0 mb-md-3 mb-xl-0"></i>
                                        </div>
                                        <p class="mb-0 mt-2 text-danger"> <span
                                                class="text-black ms-1"><small></small></span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card ">
                                <div class="card-body btn-danger">
                                    <p class="card-title text-md-center text-xl-left text-dark">Products</p>
                                    <div
                                        class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                                        <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">{{ count($products) }}</h3>
                                        <i class="ti-calendar icon-md text-dark mb-0 mb-md-3 mb-xl-0"></i>
                                    </div>
                                    <p class="mb-0 mt-2 text-danger"><span class="text-black ms-1"><small></small></span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body btn-success">
                                    <p class="card-title text-md-center text-xl-left text-dark">Stocks</p>
                                    <div
                                        class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                                        <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">{{ count($stock) }}</h3>
                                        <i class="ti-agenda icon-md text-dark mb-0 mb-md-3 mb-xl-0"></i>
                                    </div>
                                    <p class="mb-0 mt-2 text-success"><span class="text-black ms-1"><small>
                                            </small></span></p>
                                </div>
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

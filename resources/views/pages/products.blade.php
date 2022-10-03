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
                    <li class="nav-item active">
                        <a class="nav-link" href="/products">
                            <i class="ti-view-list-alt menu-icon text-dark"></i>
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
                                    <h4 class="font-weight-bold mb-0">Stationary Products</h4>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary text-light" data-toggle="modal"
                                    data-target="#exampleModal" id="btn">
                                    Add Products
                                </button>

                                <!-- Modal -->
                                <form action="create_products" method="POST" class="modal fade" id="exampleModal"
                                    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    @csrf
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">ADD PRODUCTS</h5>

                                                <button type="button" class="close btn btn-secondary" data-dismiss="modal"
                                                    aria-label="Close" id="close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="exampleInputName1">Product Name</label>
                                                    <input type="text" class="form-control" id="exampleInputName1"
                                                        name="name" placeholder="Product name">
                                                    @error('name')
                                                        <div class="text-danger">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary ">Add Product</button>
                                            </div>

                                        </div>
                                    </div>
                                </form>
                                {{-- <div> --}}

                                {{-- </div> --}}

                                <div class="table-responsive pt-2">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>
                                                    #
                                                </th>
                                                <th>
                                                    Name
                                                </th>
                                                <th>
                                                    Actions
                                                </th>

                                            </tr>
                                        </thead>
                                        <?php
                                        $no = 1;
                                        ?>
                                        @if (count($products) > 0)
                                            @foreach ($products as $product)
                                                <tbody>
                                                    <tr>
                                                        <td class="py-1">
                                                            {{ $no++ }}
                                                        </td>
                                                        <td>
                                                            {{ $product->name }}
                                                        </td>
                                                        <td>
                                                            <a class="btn-sm btn-primary"
                                                                href="edit_product/{{ $product->id }}"><i
                                                                    class="ti-pencil-alt "></i></a>
                                                            <form action="/deleteproduct/{{ $product->id }}" method="post"
                                                                style="display: inline;">
                                                                @csrf
                                                                @method('PATCH')
                                                                <input type="text" name="deleted" value="1" hidden>
                                                                <button type="submit" class="btn-sm btn-danger" href=""><i
                                                                        class="ti-trash "></i></button>
                                                            </form>

                                                        </td>

                                                    </tr>
                                            @endforeach
                                        @else
                                            <div class="alert alert-danger">
                                                No product available yet!
                                            </div>
                                        @endif


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script type="text/javascript">
                        $('#btn').on('click', function() {
                            $('#exampleModal').modal('show');
                        });

                        $('#close').on('click', function() {
                            $('#exampleModal').modal('hide');
                        });
                        // $('#close').modal('hide');
                    </script>
                @endsection

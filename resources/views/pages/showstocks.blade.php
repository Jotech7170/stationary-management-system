@extends('layouts.app')
@section('content')
    <div class="bg-white page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Stock: {{ $stock->name }}</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <div class="d-md-flex">
                    <ol class="breadcrumb ms-auto">
                    </ol>
                    <div
                        class="text-white btn btn-danger d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light">
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                                                                document.getElementById('logout-form').submit();">
                            <i class="fa fa-power-off"></i>{{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
@endsection

@section('content')
    {{-- Dashboard Stock Statistics --}}
    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">Total Products</h3>
                <ul class="mb-0 list-inline two-part d-flex align-items-center">
                    <li>
                        <div id="sparklinedash"><canvas width="67" height="30"
                                style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                        </div>
                    </li>
                    <li class="ms-auto"><span class="counter text-success">{{ $total_products }}</span></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">Total Products Sold</h3>
                <ul class="mb-0 list-inline two-part d-flex align-items-center">
                    <li>
                        <div id="sparklinedash2"><canvas width="67" height="30"
                                style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                        </div>
                    </li>
                    <li class="ms-auto"><span class="counter text-purple">{{ $total_sold }}</span></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">Total Products Remaining</h3>
                <ul class="mb-0 list-inline two-part d-flex align-items-center">
                    <li>
                        <div id="sparklinedash3"><canvas width="67" height="30"
                                style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                        </div>
                    </li>
                    <li class="ms-auto"><span class="counter text-info">{{ $total_products - $total_sold }}</span>
                    </li>
                </ul>
            </div>
        </div>
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
                                                <label class="form-check-label" for="product_item_{{ $product->id }}">
                                                    <input type="checkbox" class="form-check-input"
                                                        value="{{ $product->id }}" name="products[]"
                                                        id="product_item_{{ $product->id }}">

                                                    <i class="input-helper"></i></label>
                                            </div>
                                        </td>
                                        <td>
                                            {{ $product->name }}
                                        </td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm" placeholder="Quantity"
                                                min="1" placeholder="Quantity" name="quantity[]"
                                                id="quantity{{ $product->id }}" disabled>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm"
                                                placeholder="Buying price" name="buying_price[]"
                                                id="buying_price{{ $product->id }}" disabled>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm"
                                                placeholder="selling price" name="selling_price[]"
                                                id="selling_price{{ $product->id }}" disabled>
                                        </td>
                                        <td>
                                            <input type="date" class="form-control form-control-sm" placeholder="date"
                                                name="expire_date[]" id="expire_date{{ $product->id }}" disabled>
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
    {{-- Dashboard Stock Statistics Ends --}}
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <span class="float-left">
                Products List
            </span>
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Product name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Buying price</th>
                        <th scope="col">Selling Price</th>
                        <th scope="col">Expire date</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    ?>
                    @if (count($stock->stock_products) > 0)
                        @foreach ($stock->stock_products as $stock->stock_product)
                            <tr>
                                <th scope="row">{{ $no++ }}</th>
                                <td>{{ $stock->stock_product->products->name }}</td>
                                <td>{{ $stock->stock_product->quantity }}</td>
                                <td>{{ $stock->stock_product->buying_price }}</td>
                                <td>{{ $stock->stock_product->selling_price }}</td>
                                <td>{{ $stock->stock_product->expire_date }}</td>
                                <td>
                                    <a href="/sell_product/{{ $stock->stock_product->id }}" class="btn btn-success"
                                        data-toggle="tooltip" data-placement="bottom" title="Sale">
                                        <span><i class="fa fa-money-bill-alt"></i></span>
                                    </a>|
                                    {{-- <a href="#" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Edit">
                                    <span><i class="fa fa-edit"></i></span>
                                </a>| --}}
                                    <a href="#" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom"
                                        title="Delete">
                                        <span><i class="fa fa-trash-alt"></i></span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <div class="alert alert-danger">
                            Empty stock
                        </div>
                    @endif
                </tbody>
            </table>
        </div>
    </div>


@endsection

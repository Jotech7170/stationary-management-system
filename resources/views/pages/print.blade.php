<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Stationary Report</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
</head>


<body>
    <div class="container">
        <div class="card-body">
            <div class="card-header">
                Stationary salles Report
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Product</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                    </tr>
                </thead>
                <?php
                $no = 1;
                ?>
                <tbody>
                    @if (count($salles) > 0)
                        @foreach ($salles as $sell)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $sell->stock->name }}</td>
                                <td>{{ $sell->products->name }}</td>
                                <td>{{ $sell->quantity }}</td>
                                <td>{{ $sell->price }}</td>
                            </tr>
                        @endforeach
                    @else
                    @endif
                    <tr style="font-weight: 600;">
                        <td colspan="3">
                            Total Salles:
                        </td>
                        <td>
                            {{ $quantity_sold }}
                        </td>
                        <td>
                            {{ $total_price_sold }}
                        </td>
                    </tr>
                    <tr style="font-weight: 600;">
                        <td colspan="3">
                            Total: <small>("Before Sells")</small>
                        </td>
                        <td>
                            {{ $quantity_products }}
                        </td>
                        <td>
                            {{ $total_cost_products }}
                        </td>
                    </tr>
                    @if ($total_price_sold > $total_cost_products)
                        <tr style="font-weight: 600; color: #38c172 !important;">
                            <td colspan="4">
                                Profit:
                            </td>
                            <td>
                                {{ $loss_or_profit }}
                            </td>
                        </tr>
                    @else
                        <tr style="font-weight: 600; color: #e3342f !important;">
                            <td colspan="4">
                                Loss:
                            </td>
                            <td>
                                {{ $loss_or_profit }}
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>

<style>
    .table-bordered {
        border: 1px solid #dee2e6;
    }

    .table {
        width: 100%;
        margin-bottom: 1rem;
        color: #212529;
        font-family: poppins;
    }

    .table {
        --bs-table-bg: transparent;
        --bs-table-striped-color: #313131;
        --bs-table-striped-bg: rgba(0, 0, 0, 0.05);
        --bs-table-active-color: #313131;
        --bs-table-active-bg: rgba(0, 0, 0, 0.1);
        --bs-table-hover-color: #313131;
        --bs-table-hover-bg: rgba(0, 0, 0, 0.075);
        width: 100%;
        margin-bottom: 1rem;
        color: #313131;
        vertical-align: top;
        border-color: rgba(120, 130, 140, 0.13);
    }

    table {
        border-collapse: collapse;
    }

    table {
        caption-side: bottom;
        border-collapse: collapse;
    }

    .table>thead {
        vertical-align: bottom;
    }

    tbody,
    td,
    tfoot,
    th,
    thead,
    tr {
        border-color: inherit;
        border-style: solid;
        border-width: 0;
    }

    .table-bordered>:not(caption)>* {
        border-width: 1px 0;
    }

    tbody,
    td,
    tfoot,
    th,
    thead,
    tr {
        border-color: inherit;
        border-style: solid;
        border-width: 0;
    }

    .table>:not(:last-child)>:last-child>* {
        border-bottom-color: #e9ecef;
    }

    .table>:not(:last-child)>:last-child>* {
        border-bottom-color: currentColor;
    }

    .table-bordered thead th,
    .table-bordered thead td {
        border-bottom-width: 2px;
    }

    .table thead th {
        vertical-align: bottom;
        border-bottom: 2px solid #dee2e6;
    }

    .table thead th {
        color: #3e5569;
        font-weight: 600;
        font-size: 16px;
    }

    .table-bordered th,
    .table-bordered td {
        border: 1px solid #dee2e6;
    }

    .table th,
    .table td {
        padding: 0.75rem;
        vertical-align: top;
        border-top: 1px solid #dee2e6;
    }

    .table>tbody {
        vertical-align: inherit;
    }

    tbody,
    td,
    tfoot,
    th,
    thead,
    tr {
        border-color: inherit;
        border-style: solid;
        border-width: 0;
    }

    table tbody tr {
        color: #3e5569;
        font-weight: 400;
        font-size: 16px;
    }

    .table-bordered>:not(caption)>* {
        border-width: 1px 0;
    }

    tbody,
    td,
    tfoot,
    th,
    thead,
    tr {
        border-color: inherit;
        border-style: solid;
        border-width: 0;
    }

    .table-bordered th,
    .table-bordered td {
        border: 1px solid #dee2e6;
    }

    .table th,
    .table td {
        padding: 0.75rem;
        vertical-align: top;
        border-top: 1px solid #dee2e6;
    }

    .table td,
    .table th {
        padding: 0.9375rem 0.4rem;
    }

    .table-bordered>:not(caption)>*>* {
        border-width: 0 1px;
    }

    .table>:not(caption)>*>* {
        padding: 0.5rem 0.5rem;
        background-color: var(--bs-table-bg);
        background-image: -webkit-gradient(linear, left top, left bottom, from(var(--bs-table-accent-bg)), to(var(--bs-table-accent-bg)));
        background-image: -o-linear-gradient(var(--bs-table-accent-bg), var(--bs-table-accent-bg));
        background-image: linear-gradient(var(--bs-table-accent-bg), var(--bs-table-accent-bg));
        border-bottom-width: 1px;
    }

</style>

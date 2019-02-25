@extends('layout.app')

@section('content')
    <div class="container">
        @if (count($orders))
            <h3>Order List</h3>
            <table class="table table-striped">
                <thead>
                <tr class="text-center">
                    <th scope="col">Order No#</th>
                    <th scope="col">Order Value</th>
                    <th scope="col">Currency</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr class="text-center">
                        <td>{{ $order->order_number }}</td>
                        <td>{{ $order->subtotal_price }}</td>
                        <td>{{ $order->currency }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="card card-body alert-primary">
                <h3>Average order value: &#163;{{ number_format($order_average, 2) }}</h3>
            </div>
        @else
            <a href="/orders/fetch" class="btn btn-dark">Retrieve Orders</a>
        @endif

    </div>
@endsection
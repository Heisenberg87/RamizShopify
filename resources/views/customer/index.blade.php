@extends('layout.app')

@section('content')
    <div class="container">
        @if(count($customers) > 0)
            <h1>Customers</h1>
            <table class="table table-striped">
                <thead>
                <tr class="text-center">
                    <th scope="col">First Name</th>
                    <th scope="col">Lastname</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($customers as $customer)
                    <tr class="text-center">
                        <td>{{ $customer->first_name }}</td>
                        <td>{{ $customer->last_name }}</td>
                        <td><a href="/customers/{{$customer->customer_id}}" class="btn btn-dark" />Average order value</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <a href="/customers/fetch" class="btn btn-dark">Retrieve Customers</a>
        @endif
    </div>
@endsection



@extends('layout.app')

@section('content')
    <div class="container">
        @if (count($products) > 0)
            <h1>Products</h1>
            <table class="table table-striped">
                <thead>
                <tr class="text-center">
                    <th scope="col">Title</th>
                    <th scope="col">Vendor</th>
                    <th scope="col">Tags</th>
                    <th scope="col">No of variants</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr class="text-center">
                        <td>{{ $product->title }}</td>
                        <td>{{ $product->vendor }}</td>
                        <td>{{ $product->tags }}</td>
                        <td>
                           {{count($product->variants)}}
                        </td>
                        <td><a href="/variants/{{$product->id}}" class="btn btn-dark" />Average variant value</a></td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <a href="/products/fetch" class="btn btn-dark">Retrieve Products</a>
        @endif
    </div>
@endsection